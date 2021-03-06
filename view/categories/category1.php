<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo"><?= $h1; ?></h1>
        <h2><?= $titre_for_layout ?></h2>
        <p id="phraseCategorie"><?= $text_for_layout ?></p>
        <br>
        <small><?= ($services) ? 'Ajustez le tri des experts :' : 'Aucun expert dans cette catégorie.'; ?></small>
        <div class="search-filters row">
            <form class="span6 text-right" action="<?= $_SERVER['SCRIPT_URI']; ?>" method="post">
                <select name="sort" class="width-170">
                    <option value="callCount"<?php if ($this->Session->read('sortBy') == 'callCount') echo ' selected="selected"'; ?>>Les plus consultés</option>
                    <option value="rateCount"<?php if ($this->Session->read('sortBy') == 'rateCount') echo ' selected="selected"'; ?>>Les mieux notés</option>
                    <option value="id"<?php if ($this->Session->read('sortBy') == 'id') echo ' selected="selected"'; ?>>Les nouveaux</option>
                </select>
            </form>
            <span class="layout-switch span6 text-left">
                <a class="btn btn-info btn-large" title="Affichage en liste" href="#list"><i class="icon-list"></i></a>
                <a class="btn btn-info btn-large active" title="Affichage en grille" href="#grid"><i class="icon-th"></i></a>
            </span>
        </div>
    </div>
</div>
<div class="container list">
	<script type="text/javascript">
		var servicesid = new Array();
	</script>
    <?php foreach ($services as $k => $v): ?><?php $v = current($v); ?>
        <div class="row demo-tiles">
            <div class="span5 service">
                <img class="rounded" src="<?= IMAGE; ?>services/<?= $v->img; ?>" width="100" height="100">
                <div class="left">
                    <span class="title"><?= ($v->username == '') ? $v->user->first_name . ' ' . $v->user->last_name : utf8_decode($v->username); ?>
                        <br><small><?= $v->title; ?> (<?= $v->calls; ?>)</small></span>
                </div>
            </div>
            <div class="span2">
                <div class="rating no-margin-top">
                    <h4>Note</h4>
                    <p class="up blue"><?= str_replace('.00', '', $v->rating); ?></p>
                </div>
            </div>
            <div class="span2">
                <div class="rating no-margin-top">
                    <h4>Prix</h4>
                    <p class="up"><?= number_format($v->cost_per_minute, 2); ?> €<sub> / min</sub></p>
                </div>
            </div>
            <div class="span3">
                <a class="btn btn-info btn-large btn-block" href="<?= Router::url('services/view/cat:' . $v->category . '/subcat:' . $v->subcategory . '/' . $v->url); ?>">Voir sa fiche</a>
                
                <a style="display:<?= ($v->available == 1)? '' : 'none' ?>" class="btn btn-primary btn-large btn-block call_button call_button_ok_<?= $v->id ?>" href="<?= Router::url('calls/call/' . $v->url); ?>">Appeler</a>
                <span style="display:<?= ($v->available == 2)? '' : 'none' ?>" class="btn btn-danger btn-large btn-block call_button call_button_occupe_<?= $v->id ?>">En consultation</span>
                <span style="display:<?= ($v->available == 0)? '' : 'none' ?>" class="btn btn-large btn-block disabled call_button call_button_indisponible_<?= $v->id ?>">Indisponible</span>
            </div>
        </div>
        <script type="text/javascript">
        	servicesid["<?= $v->id ?>"] = "<?= $v->id ?>";
        </script>
    <?php endforeach; ?>
    <script>
	      $(function(){
	        global_nre = setInterval(function(){

	          $.ajax({
	            type : "POST",
	            url : "/services/occupe_view_all",
	            data : {servicesid:servicesid},
	            success : function(s_html){
	              var message = JSON.parse(s_html);
	              $(".call_button").css("display","none");

	              for(status in message)
	              {
	              	if(message[status] == 1)
	          		{
              			$(".call_button_ok_"+status).css("display","");
	          		}
	          		else{
	          			if(message[status] == 0)
	          			{
              				$(".call_button_indisponible_"+status).css("display","");
	          			}
	          			else
	          			{
              				$(".call_button_occupe_"+status).css("display","");
	          			}
	          		}
	              }
	            },
	            error : function(e_html){
	              e_message = $.trim(e_html);
	              console.log("error"+e_message);
	            },});
	        }, 2000);
	      });

	  </script>
</div>
<div class="container grid" >
  <div class="row" style="float:left; width:960px;margin-left:-180px; ">
    <?php foreach ($services as $k=>$v): ?><?php $v = current($v); ?>
<div>
    <div class="expert expert-grid span3 text-center" style="word-wrap:break-word;width:449px;height:168px; border:1px solid #d8d8d8;-moz-border-radius:7px;-webkit-border-radius:7px;border-radius:13px;">
    <div style="float:left;" >
      <a href="<?= Router::url('services/view/cat:'.$v->category.'/subcat:'.$v->subcategory.'/'.$v->url); ?>"><img class="rounded" style="margin-bottom:10px;" src="<?= IMAGE; ?>services/<?= $v->img; ?>" alt="" /></a>
    </div>
    <div style="float:rigth;" >
      <span class="title"><?= ($v->username == '') ? $v->user->first_name.' '.$v->user->last_name:utf8_decode($v->username); ?></span>
      <?php if ($v->promoBienvenue): ?>
                            <span class="labelpromo"><?= $v->promoBienvenue; ?></span>
                        <?php else: ?>
                            <span class="label"><?= number_format($v->cost_per_minute, 2); ?> €/min - <?= number_format($v->cost_per_call, 2); ?> €/appel</span>
                        <?php endif; ?>
      <h6 style="color:#aaa;margin-top:0;font-size:0.85em;height:40px;word-wrap:break-word;"><?= $v->title; ?>
       </h6>
      <div style="margin-bottom:0.5em;column-gap : 3rem">
        <small>
          <span class="label"><?= str_replace('.00','',$v->rating); ?></span> 
          <span class="label"><?= $v->callCount; ?><i class="icon-phone"></i></span>
          <?php if ($v->promo): ?>
          <span class="labelpromo"><?= $v->promo; ?></span>
          <?php else: ?>
          <span class="label"><?= number_format($v->cost_per_minute,2); ?> €/min</span>
          <?php endif; ?>
        </small>
      </div>
		    <a class="btn btn-info tiny" href="<?= Router::url('services/view/cat:'.$v->category.'/subcat:'.$v->subcategory.'/'.$v->url); ?>">Voir sa fiche</a>

		    <a style="display:<?= ($v->available == 1)? '' : 'none' ?>" class="btn btn-primary tiny call_button call_button_ok_<?= $v->id ?>" href="<?= Router::url('calls/call/' . $v->url); ?>">Appeler</a>
		    <span style="display:<?= ($v->available == 2)? '' : 'none' ?>" class="btn btn-danger tiny call_button call_button_occupe_<?= $v->id ?>">En consultation</span>
		    <span style="display:<?= ($v->available == 0)? '' : 'none' ?>" class="btn tiny disabled call_button call_button_indisponible_<?= $v->id ?>">Indisponible</span>
            </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
<?= $this->HTML->js('jquery.totemticker'); ?>
<?= $this->HTML->js('jquery-scrolltofixed-min'); ?>
<?= $this->HTML->js('jquery-scrolltofixed'); ?>
<?= $this->HTML->js('jquery.scroll-vertical'); ?> 
<?= $this->HTML->css('css.scroll-vertical'); ?>
  <div style="float:right;width:160px;" >
 <?php $slug = $category->title; ?>
 <div class="content">
          <?php $slug = $category->title;?>
                    <ul id="summary">
                        <li class="title">Derniers avis clients</li>
                    <ul id="vertical-ticker" class="contents">
 <?php 
    			$this->loadModel('Rating');
    			$reviews = $this->Rating->findBy(array('order'=>'id DESC'));
          //var_dump($reviews);
    			foreach ($reviews as $k=>$v) {
    				$this->loadModel('User');
	    			$this->loadModel('Service');
	    			$this->loadModel('Category');
	    			$this->loadModel('Subcategory');
	    			$v->Rating->user = current($this->User->findOneBy(array('conditions'=>array('profile_id'=>$v->Rating->profile_id))));
	    			$v->Rating->service = current($this->Service->findOneBy(array('conditions'=>array('id'=>$v->Rating->service_id))));
	    			$v->Rating->expert = current($this->User->findOneBy(array('conditions'=>array('profile_id'=>$v->Rating->service->profile_id))));
	    			$v->Rating->username = ($v->Rating->service->username == '') ? $v->Rating->expert->last_name.'-'.$v->Rating->expert->first_name:$v->Rating->service->username;
	    			$v->Rating->category = current($this->Category->findOneBy(array('conditions'=>array('id'=>$v->Rating->service->category_id))));
            		$v->Rating->subcategory = current($this->Subcategory->findOneBy(array('conditions'=>array('id'=>$v->Rating->service->subcategory_id))));
    			} 
    		?>
    		<?php if (isset($reviews) && $reviews): ?>
      
							<?php foreach ($reviews as $k=>$v): ?><?php $v = current($v); ?>
                                   
    		            <?php  if ($slug == $v->category->title): ?>
             <li >
              <span class="label label_default review_rating"><?= $v->rate; ?>/10</span>
              <?php $date = explode("-", $v->date); 
              switch($date[1]) {
              case 01: $mois="Janvier"; break;
              case 02: $mois="Fevrier"; break;
              case 03: $mois="March"; break;
              case 04: $mois="Avril"; break;
              case 05: $mois="Mai"; break;
              case 06: $mois="Juin"; break;
              case 07: $mois="Juillet"; break;
              case 08: $mois="Aout"; break;
              case 09: $mois="Septembre"; break;
              case 10: $mois="Octobre"; break;
              case 11: $mois="Novembre"; break;
              case 12: $mois="Decembre"; break;
              }
              ?>
							  Le <?php echo $date[2], " "; echo $mois, " "; echo $date[0]; ?> : <?= $v->user->first_name; ?> a consulté <a href="<?= Router::url('services/view/cat:'.$v->category->slug.'/subcat:'.$v->subcategory->slug.'/slug:'.clean($v->username).'/id:'.$v->service->id); ?>"><?= $v->username; ?>, <?= $v->service->title; ?></a> : <?= $v->comment; ?>
             </li>
                  <?php endif; ?>
             <?php endforeach; ?>
		    <?php endif; ?>
            </ul>
            
            </ul>
     </div>
</div>

  