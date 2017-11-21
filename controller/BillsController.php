<?php

    class BillsController extends Controller {

    	public $uses = array('Repayment','User','Service');

        public function pdf_repayment($id) {

            if (!isset($id)) {
				$this->error();
				die();
			}

			$repayment = $this->Repayment->findOneBy(array('conditions'=>array('id'=>$id)));

			if (!$repayment) {
				$this->error();
				die();
			}

			$repayment = current($repayment);

			$service = $this->Service->findOneBy(array('conditions'=>array('id'=>$repayment->service_id)));

			if (!$service) {
				$this->error();
				die();
			}

			$service = current($service);

			$user = $this->User->findOneBy(array('conditions'=>array('profile_id'=>$service->profile_id)));

			if (!$user) {
				$this->error();
				die();
			}

			$user = current($user);

			require CORE.'/pdf/tcpdf/config/lang/fra.php';
    		require CORE.'/pdf/tcpdf/tcpdf.php';

			// On crée un nouveau document pdf au format A4.
			$pdf = new TCPDF('P','mm',array(297,210),true,'UTF-8',false);
			// On casse le formatage.
			$pdf->SetAutoPageBreak(false, 0);
			// On crée une page.
			$pdf->AddPage();


			// On importe le logo.
			$pdf->Image('../bin/images/facture/logo.jpg',28,17);

			// On insere les informations sur la societe.
			$pdf->SetFont('droidsans','b',12);
			$pdf->SetTextColor(198,199,200);
			$pdf->SetXY(20,60);
			$pdf->Write(0,'http://www.esatus.fr');
			$pdf->SetXY(122,60);
			$pdf->Write(0,'Date : '.prettyDate($repayment->date));

			$pdf->SetFont('ubuntu','',11);
			$pdf->SetTextColor(217,218,219);
			$pdf->SetXY(20,70);
			$pdf->Write(0,'site édité par la SARL 4U Consulting au capital social de 1.000,00 euros');
			$pdf->SetXY(20,75);
			$pdf->Write(0,'29, Grand Rue 59100 ROUBAIX');
			$pdf->SetXY(20,80);
			$pdf->Write(0,'SIREN : 523 411 866');
			$pdf->SetXY(20,85);
			$pdf->Write(0,'TVA intracommunautaire : FR75 523 411 866');
			$pdf->SetXY(20,90);
			$pdf->Write(0,'service client : 04 66 79 32 29');
			$pdf->SetXY(20,95);
			$pdf->Write(0,'email : contact@esatus.fr');


			// On importe le cadre pour les informations du client.
			$pdf->Image('../bin/images/facture/en-tete.jpg',113,17);
			$pdf->SetTextColor(255,255,255);

			// On insere les informations du client.
			$pdf->SetFont('droidsans','b',12);
			$pdf->SetXY(122,23);
			$pdf->Write(0,'CLIENT');

			$pdf->SetFont('ubuntu','',12);
			$pdf->SetXY(122,33);
			$pdf->Write(0,strtoupper(str_replace('-',' ',clean($user->first_name.' '.$user->last_name))));
			$pdf->SetXY(122,38);
			$pdf->Write(0,$service->title);
			$pdf->SetXY(122,43);
			$pdf->Write(0,str_replace('33','0',$service->phone));

			
			// On importe la barre
			$pdf->Image('../bin/images/facture/barre.jpg',18,106);
			$pdf->SetTextColor(255,255,255);

			// 
			$pdf->SetFont('droidsans','b',11);
			$pdf->SetTextColor(255,255,255);
			$pdf->SetXY(25,109.5);
			$pdf->Cell(0,0,"Libéllé des produits",0,1);
			$pdf->SetXY(120,109.5);
			$pdf->Cell(15,0,"Qté",0,1,'C');
			$pdf->SetXY(135,109.5);
			$pdf->Cell(25,0,"Prix U.",0,1,'C');
			$pdf->SetXY(160,109.5);
			$pdf->Cell(30,0,"Total ligne",0,1,'C');


			// On importe le cadre
			$pdf->Image('../bin/images/facture/corps.jpg',20,120);

			// 
			$pdf->SetFont('ubuntu','',11);
			$pdf->SetTextColor(217,218,219);
			$pdf->SetXY(25,123.5);
			$pdf->Cell(0,0,"Commission sur consultations téléphonique",0,1);
			$pdf->SetXY(120,123.5);
			$pdf->Cell(15,0,"1",0,1,'C');
			$pdf->SetXY(135,123.5);
			$pdf->Cell(25,0,number_format($repayment->amount,2)." €",0,1,'C');
			$pdf->SetXY(160,123.5);
			$pdf->Cell(30,0,number_format($repayment->amount,2)." €",0,1,'C');
			$margin = 6;

			// TVA
			$ht = $repayment->amount / 1.2;
			$tva = $repayment->amount - $ht;

			$pdf->SetFont('ubuntu','',11);
			$pdf->SetTextColor(217,218,219);
			$pdf->SetXY(25,123.5+$margin);
			$pdf->Cell(0,0,"Dont TVA",0,1);
			$pdf->SetXY(120,123.5+$margin);
			$pdf->Cell(15,0,"1",0,1,'C');
			$pdf->SetXY(135,123.5+$margin);
			$pdf->Cell(25,0,number_format($tva,2)." €",0,1,'C');
			$pdf->SetXY(160,123.5+$margin);
			$pdf->Cell(30,0,number_format($tva,2)." €",0,1,'C');
			

			// On affiche le numéro de facture
			$pdf->SetFont('droidsans','b',11);
			$pdf->SetTextColor(217,218,219);
			$pdf->SetXY(20,258);
			$pdf->Write(0,'Facture n°'.$id);


			// On affiche le total
			$pdf->SetFont('droidsans','b',14);
			$pdf->SetTextColor(51,168,219);
			$pdf->SetXY(118,257);
			$pdf->Write(0,'TOTAL TTC');

			$pdf->Image('../bin/images/facture/total.jpg',146,252,44,14);
			$pdf->SetFont('ubuntu','b',16);
			$pdf->SetTextColor(255,255,255);
			$pdf->SetXY(148,255);
			$pdf->Cell(40,0,number_format($repayment->amount,2).' €',0,1,'C');


			// Mentions légales.
			$pdf->SetFont('ubuntu','',9);
			$pdf->SetTextColor(217,218,219);
			$pdf->SetXY(0,280);
			$pdf->Cell(210,0,'SARL 4U Consulting, société au capital social de 1.000,00 euros - 29, Grand Rue 59100 ROUBAIX - SIREN : 523 411 866',0,1,'C');
			$pdf->SetXY(0,285);
			$pdf->Cell(210,0,'TVA intracommunautaire : FR75 523 411 866 - service client : 04 66 79 32 29 - email : serviceesatus@orange.fr',0,1,'C');



			// On exporte le document
			$pdf->Output('facture.pdf');
            
        }
        
    }

?>