<?php

    class Model {
        
        private $db;
        
        private $conf = 'default';
        
        public $belongsTo = false;

        public $hasMany = false;

        private $habtm = false;

        public $name = false;

        public $table = false;
        
        public $id;
        
        public $errors = array();
        
        public $form;

        public $recursive;
        
        /**
         *  La méthode __construct() est appelé lors de la création d'une occurence de la classe Model.
         */
        public function __construct($recursive=true) {
            
            $this->recursive = $recursive;
            $this->connect();

            $this->name = strtolower(get_class($this));

            if ($this->table === false) {
                $this->table = strtolower(get_class($this)).'s';
            }

            if ($this->recursive) {
                $this->checkHasAndBelongsToMany();
            }
            
        }

        private function connect() {

            $conf = Conf::database();
            try {
                $pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';',$conf['login'],$conf['password']);
                $this->db = $pdo;
            } catch (PDOException $e) {
                die($e->getMessage());
            }

        }

        private function checkHasAndBelongsToMany() {

            if ($this->belongsTo !== false && $this->hasMany !== false) {
                $this->habtm = array_merge($this->belongsTo,$this->hasMany);
            } else if ($this->belongsTo !== false) {
                $this->habtm = $this->belongsTo;
            } else if ($this->hasMany !== false) {
                $this->habtm = $this->hasMany;
            }

            if ($this->habtm !== false) {
                $this->loadModels();
            }

        }

        private function loadModels() {
            
            foreach ($this->habtm as $model) {
                if (!isset($this->$model)) {
                    $file = ROOT.DS.'model'.DS.$model.'.php';
                    require_once $file;
                    $this->$model = new $model(false);
                }   
            }

        }

        /**
         *  La méthode validate($rules,$data) permet de vérifier que les données fournies correspondent aux règles.
         *  @param       $rules
         *  @param       $data
         *  @return      Boolean
         */
        public function validate($rules,$data) {
            
            $errors = array();
            
            foreach($rules as $k => $v) {
                if (!isset($data->$k)) {
                    $errors[$k] = $v['message'];
                } else {
                    if ($v['rule'] == 'notEmpty') {
                        if (empty($data->$k)) {
                            $errors[$k] = $v['message'];
                        }
                    }  elseif ($v['rule'] == 'email') {
                        if (!filter_var($data->$k, FILTER_VALIDATE_EMAIL)) {
                            $errors[$k] = $v['message'];
                        }
                    }   elseif ($v['rule'] == 'phone') {
                        if (!preg_match('#^0[0-9]{9}$#',$data->$k)) { 
                            $errors[$k] = $v['message'];
                        }
                    }  elseif (!preg_match('/'.$v['rule'].'/',$data->$k)) {
                        $errors[$k] = $v['message'];
                    }
                }
            }
            
            $this->errors = $errors;
            if (isset($this->Form)) {
                $this->Form->errors = $errors;
            }
            
            if (empty($errors)) {
                return true;
            } else {
                return false;
            }
            
        }

        /**
         * La méthode count() retourne le nombre d'entités pour une condition donnée.
         * @return      Integer
         */
        public function count() {
            
            $result = $this->findAll();
            return ($result) ? count($result):0;
            
        }

        public function average($field,$conditions) {

            $q = 'SELECT AVG('.$field.') AS average FROM '.$this->table.' WHERE '.$conditions;
            $sql = $this->db->prepare($q);
            $sql->execute();

            $result = new stdClass();
            $name = ucfirst($this->name);
            $result->$name = $this->normalize(current($sql->fetchAll(PDO::FETCH_OBJ)));
            $sql->closeCursor();

            return $result;

        }

        /**
         * La méthode find($id) récupère tout simplement l'entité correspondant à l'id $id.
         * @param       $id
         * @return      stdClass 
         */
        public function find($id) {

            $q = 'SELECT * FROM '.$this->table.' WHERE id = '.$id;
            $sql = $this->db->prepare($q);
            $sql->execute();

            $result = new stdClass();
            $name = ucfirst($this->name);
            $result->$name = $this->normalize(current($sql->fetchAll(PDO::FETCH_OBJ)));

            if ($this->recursive !== false) {
                if ($this->belongsTo !== false) {
                    foreach ($this->belongsTo as $model) {
                        $modelname = $this->$model->name;
                        $key = $modelname.'_id';
                        $id = $result->$name->$key;
                        $modelname = ucfirst($modelname);
                        $result->$modelname = current($this->$model->find($id));
                    }
                }

                if ($this->hasMany !== false) {
                    foreach ($this->hasMany as $model) {
                        $modelname = $this->$model->name;
                        $tablename = ucfirst($this->$model->table);
                        $key = strtolower($name).'_id';
                        $id = $result->$name->id;
                        $modelname = ucfirst($modelname);
                        $result->$tablename = $this->$model->findBy(array(
                            'conditions'=>array(
                                $key=>$id
                            )
                        ));
                    }
                }
            }

            $sql->closeCursor();
            return $result;

        }

        /**
         * La méthode findAll() retourne toutes les entités. Le format du retour est un simple Array, que vous pouvez parcourir (avec un foreach par exemple) pour utiliser les objets qu'il contient.
         * @return      Array 
         */
        public function findAll() {

            $q = 'SELECT * FROM '.$this->table;
            $sql = $this->db->prepare($q);
            $sql->execute();
            $results = $this->normalize($sql->fetchAll(PDO::FETCH_OBJ));
            $results = $this->parseData($results);
            $sql->closeCursor();
            return $results;

        }
        
        /**
         * La méthode findAll() retourne toutes les entités. Le format du retour est un simple Array, que vous pouvez parcourir (avec un foreach par exemple) pour utiliser les objets qu'il contient.
         * @return      Array 
         */
        public function deletAll() {

            $q = 'TRUNCATE '.$this->table;
            $sql = $this->db->prepare($q);
            $sql->execute();
            $results = $this->normalize($sql->fetchAll(PDO::FETCH_OBJ));
            $results = $this->parseData($results);
            $sql->closeCursor();
            return $results;

        }
        
        /**
         * La méthode findBy($query) est un peu plus intéressante. Comme findAll() elle permet de retourner une liste d'entité, sauf qu'elle est capable d'effectuer un filtre pour ne retourner que les entités correspondant à un critère. Elle peut aussi trier les entités, et même n'en récupérer qu'un certain nombre (pour une pagination).
         * @param       $query
         * @return      Array 
         */
        public function findBy($query) {
            
            $q = 'SELECT ';
            
            // Construction de la recherche des champs à renvoyer.
            if (isset($query['fields'])) {
                if (is_array($query['fields'])) {
                    $q .= implode(', ',$query['fields']);
                } else {
                    $q .= $query['fields'];
                }
            } else {
                $q .= '*';
            }
            
            $q .= ' FROM '.$this->table;
            
            // Construction de la condition.
            if (isset($query['conditions'])) {
                $q .= ' WHERE ';
                if (!is_array($query['conditions'])) {
                    $q .= $query['conditions'];
                } else {
                    $cond = array();
                    foreach($query['conditions'] as $k=>$v) {
                        if (!is_numeric($v)) {
                            $v = '"'.mysql_escape_string($v).'"';
                        }
                        $cond[] = $k.'='.$v;
                    }
                    $q .= implode(' AND ',$cond);
                }
            }
            
            // Construction de l'ordre de retour.
            if (isset($query['order'])) {
                $q .= ' ORDER BY '.$query['order'];
            }
            
            // Construction de la limit pour pagination.
            if (isset($query['limit'])) {
                $q .= ' LIMIT '.$query['limit'];
            }
            
            //print_r($q);die();
            $sql = $this->db->prepare($q);
            $sql->execute();
            $results = $this->normalize($sql->fetchAll(PDO::FETCH_OBJ));
            $results = $this->parseData($results);
            $sql->closeCursor();
            return $results;
            
        }
        
        public function findCalldetail($query) {
        
        	$q = 'SELECT ';
        
        	// Construction de la recherche des champs à renvoyer.
        	if (isset($query['fields'])) {
        		if (is_array($query['fields'])) {
        			$q .= implode(', ',$query['fields']);
        		} else {
        			$q .= $query['fields'];
        		}
        	} else {
        		$q .= '*';
        	}
        
        	//$q .= ' FROM '.$this->table;
        	$q .= ' FROM bit_cdr';
        
        	// Construction de la condition.
        	if (isset($query['conditions'])) {
        		$q .= ' WHERE ';
        		if (!is_array($query['conditions'])) {
        			$q .= $query['conditions'];
        		} else {
        			$cond = array();
        			foreach($query['conditions'] as $k=>$v) {
        				if (!is_numeric($v)) {
        					$v = '"'.mysql_escape_string($v).'"';
        				}
        				$cond[] = $k.'='.$v;
        			}
        			$q .= implode(' AND ',$cond);
        		}
        	}
        
        	// Construction de l'ordre de retour.
        	if (isset($query['order'])) {
        		$q .= ' ORDER BY '.$query['order'];
        	}
        
        	// Construction de la limit pour pagination.
        	if (isset($query['limit'])) {
        		$q .= ' LIMIT '.$query['limit'];
        	}
        
        	$sql = $this->db->prepare($q);
        	$sql->execute();
        	$results = $this->normalize($sql->fetchAll(PDO::FETCH_OBJ));
        	$results = $this->parseData($results);
        	$sql->closeCursor();
        	return $results;
        
        }
        
        public function findCallprogress($query) {
        
        	$q = 'SELECT ';
        
        	// Construction de la recherche des champs à renvoyer.
        	if (isset($query['fields'])) {
        		if (is_array($query['fields'])) {
        			$q .= implode(', ',$query['fields']);
        		} else {
        			$q .= $query['fields'];
        		}
        	} else {
        		$q .= '*';
        	}
        
        	//$q .= ' FROM '.$this->table;
        	$q .= ' FROM callstate';
        
        	// Construction de la condition.
        	if (isset($query['conditions'])) {
        		$q .= ' WHERE ';
        		if (!is_array($query['conditions'])) {
        			$q .= $query['conditions'];
        		} else {
        			$cond = array();
        			foreach($query['conditions'] as $k=>$v) {
        				if (!is_numeric($v)) {
        					$v = '"'.mysql_escape_string($v).'"';
        				}
        				$cond[] = $k.'='.$v;
        			}
        			$q .= implode(' AND ',$cond);
        		}
        	}
        
        	// Construction de l'ordre de retour.
        	if (isset($query['order'])) {
        		$q .= ' ORDER BY '.$query['order'];
        	}
        
        	// Construction de la limit pour pagination.
        	if (isset($query['limit'])) {
        		$q .= ' LIMIT '.$query['limit'];
        	}
        
        	$sql = $this->db->prepare($q);
        	$sql->execute();
        	$results = $this->normalize($sql->fetchAll(PDO::FETCH_OBJ));
        	$results = $this->parseData($results);
        	$sql->closeCursor();
        	return $results;
        
        }
        
        /**
         * La méthode findOneBy($query) fonctionne sur le même principe que la méthode findBy(), sauf qu'elle ne retourne qu'une seule entité.
         * @param       $query
         * @return      stdClass
         */
        public function findOneBy($query) {
            
            return current($this->findBy($query));
            
        }
        
        /**
         * La méthode search($query) retourner une liste d'entités correspondant aux termes recherchés. 
         * @param       $query
         * @return      Array
         */
        public function search($query) {
            
            $q = 'SELECT ';

            if (isset($query['fields'])) {
                if (is_array($query['fields'])) {
                    $q .= implode(', ',$query['fields']);
                } else {
                    $q .= $query['fields'];
                }
            } else {
                $q .= '*';
            }

            $q .= ', MATCH (';

            if (isset($query['match'])) {
                if (is_array($query['match'])) {
                    $q .= implode(', ',$query['match']);
                } else {
                    $q .= $query['match'];
                }
            } 

            $q .= ') AGAINST ("';

            if (isset($query['against'])) {
                if (is_array($query['against'])) {
                    foreach ($query['against'] as $k) {
                        $q .= $k.' ';
                    }
                } else {
                    $q .= $query['against'];
                }
            } 

            if (isset($query['mode'])) {
                if ($query['mode']) {
                    $q .= '" IN BOOLEAN MODE';
                } else {
                    $q .= '"';
                }
            } else {
                $q .= '"';
            }        

            $q .= ') AS cpt';

            $q .= ' FROM '.$this->table;

            if (isset($query['conditions'])) {
                $q .= ' WHERE ';
                if (!is_array($query['conditions'])) {
                    $q .= $query['conditions'];
                } else {
                    $cond = array();
                    foreach($query['conditions'] as $k=>$v) {
                        if (!is_numeric($v)) {
                            $v = '"'.mysql_escape_string($v).'"';
                        }
                        $cond[] = $k.'='.$v;
                    }
                    $q .= implode(' AND ',$cond);
                }
            }

            $q .= ' ORDER BY cpt DESC';

            if (isset($query['limit'])) {
                $q .= ' LIMIT '.$query['limit'];
            }

            $sql = $this->db->prepare($q);
            $sql->execute();
            $results = $this->normalize($sql->fetchAll(PDO::FETCH_OBJ));
            $results = $this->parseData($results);
            $sql->closeCursor();
            return $results;
            
        }

        /**
         * La méthode normalize($results) permet d'éviter de faire un post traitement des données. En effet celles-ci seront automatiquement encodées en utf8 et antislashées.
         * @param       $results
         * @return      Array || stdClass
         */
        private function normalize($results) {            

            if ($results) {
                if (is_array($results)) {
                    foreach ($results as $result) {
                        foreach ($result as $k=>$v) {
                            if ($this->table != 'cards') {
                                $result->$k = stripslashes(utf8_encode($v));   
                            } 
                        }
                    }
                } else {
                    foreach ($results as $k=>$v) {
                        if ($this->table != 'cards') {
                            $results->$k = stripslashes(utf8_encode($v));
                        }
                    }
                }
                
            }
            return $results;
        }

        private function parseData($results) {

            if ($this->recursive !== false) {
                foreach ($results as $k=>$v) {  

                    unset($results[$k]);
                    $result = new stdClass();
                    $name = ucfirst($this->name);
                    $result->$name = $v;
                    
                    if ($this->belongsTo !== false) {
                        foreach ($this->belongsTo as $model) {
                            $model = ucfirst($model);
                            $modelname = $this->$model->name;
                            $key = $modelname.'_id';
                            $id = $v->$key;
                            $modelname = ucfirst($modelname);
                            $result->$modelname = current($this->$model->find($id));
                        }
                    }

                    if ($this->hasMany !== false) {
                        foreach ($this->hasMany as $model) {
                            $model = ucfirst($model);
                            $modelname = $this->$model->name;
                            $tablename = ucfirst($this->$model->table);
                            $key = strtolower($name).'_id';
                            $id = $v->id;
                            $modelname = ucfirst($modelname);
                            $result->$tablename = $this->$model->findBy(array(
                                'conditions'=>array(
                                    $key=>$id
                                )
                            ));
                        }                        
                    }

                    $results[$k] = $result;

                }
            } 

            return $results;

        }
        
        /**
         * La méthode save($data) permet de modifier ou sauvegarder une entité. 
         * @param       $data
         * @return      Boolean
         */
        public function save($data) {
            
            $key = 'id';
            $fields = array();
            $d = array();
            foreach($data as $k => $v) {
                if ($k != 'id') {
                    $fields[] = $k.'=:'.$k;
                    $d[":$k"] = $v;
                } elseif (!empty($v)) {
                    $d[":$k"] = $v;
                }
            }
            if (isset($data->$key) && !empty($data->$key)) {
                $q = 'UPDATE '.$this->table.' SET '.implode(', ',$fields).' WHERE '.$key.' =:'.$key;
                $this->id = $data->$key;
                $this->id = $data->$key;
                $action = 'update';
            } else {
                $q = 'INSERT INTO '.$this->table.' SET '.implode(', ',$fields);
                $action = 'insert';
            }

            $sql = $this->db->prepare($q);
            $return = $sql->execute($d);
            if ($action == 'insert') {
                $this->id = $this->db->lastInsertId();
            }
            $sql->closeCursor();
            
            return $return;
            
        }

        //updated by andru
        /*public function save($data) {
            
            $key = 'id';
            $fields = array();
            $d = array();
            foreach($data as $k => $v) {
                if ($k != 'id') {
                    $fields[] = $k." = '".$v."'";
                    $d[":$k"] = $v;
                } elseif (!empty($v)) {
                    $d[":$k"] = $v;
                }
            }
            if (isset($data->id)) {
                $q = 'UPDATE '.$this->table.' SET '.implode(', ',$fields).' WHERE id ='.$data->id;
                $this->id = $data->id;
                $this->id = $data->id;
                $action = 'update';
            } else {
                $q = 'INSERT INTO '.$this->table.' SET '.implode(', ',$fields);
                $action = 'insert';
            }
            
            $sql = $this->db->prepare($q);
            $return = $sql->execute($d);
            if ($action == 'insert') {
                $this->id = $this->db->lastInsertId();
            }
            $sql->closeCursor();
            
            return $return;
            
        }*/

        /**
         * La méthode delete($id) permet de supprimer l'entité qui possède l'id $id. 
         * @param       $data
         */
         
         //simple methode pour l'insertion des info concernant le parainage
        
        public function parainage($user_email,$sender_email) {
        
        $q = 'INSERT INTO link_parainage VALUES ("", "'.$user_email.'", "'.$sender_email.'") ';
        $this->db->query($q);
       // return $return;
        
        }
         
        public function delete($id) {
            
            $q = "DELETE FROM {$this->table} WHERE id = $id";
            $this->db->query($q);
            
        }

        //added by andru
        public function cumul_unpaid($id)
        {
            $q = 'SELECT round(sum(cost),2) as cumul from '.$this->table.' WHERE user_id = '.$id.' AND rib = 1 AND payment = 0';

            $sql = $this->db->prepare($q);
            $sql->execute();
            
            $results = $this->normalize($sql->fetchAll(PDO::FETCH_OBJ));
            $results = $this->parseData($results);
            $sql->closeCursor();
            return $results;
        }
        
    }

?>