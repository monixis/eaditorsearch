<?php
class eaditorsearch extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();

    }

    public function test($val){
		$date = date_default_timezone_set('US/Eastern');
		echo $val;
	 }

    public function index()
    {  
        $date = date_default_timezone_set('US/Eastern');
       
        if($this -> input -> get('key'))
            $data["key"] = $this -> input -> get('key');
        else
            $data["key"] = "";

        if($this -> input -> get('facet'))
            $data["facet"] = $this -> input -> get('facet');
        else
            $data["facet"]="";
        $this->load->view('search', $data);
    }
       
  public function searchKeyWords($key, $facet)
	{
        $key = trim($key);
        $key = str_replace("%2520","+", $key);
        $key = str_replace("fq%3D","&fq=", $key);
        $key = str_replace("%252C","%2C", $key);
        $key = str_replace("&#40;","%28", $key);
        $key = str_replace("&#41;","%29", $key);
	$key = str_replace("%2527", "'", $key);
        if($facet != "NULL"){
            $resultsLink = "http://www.empireadc.org:8080/solr/eaditor-published/select?indent=on&q=*:*&fq=".$facet.'%3A%22'. $key .'%22'."&wt=json&facet=true&facet.field=subject_facet&facet.field=agency_facet&facet.field=corpname_facet&facet.field=genreform_facet&facet.field=persname_facet&facet.field=language_facet&facet.field=century_num&facet.field=famname_facet&facet.field=geogname_facet&rows=1500";
            //$resultsLink = "http://www.empireadc.org:8080/solr/eaditor-published/select?indent=on&q=*:*&fq=".$facet.'%3A%22'. $key .'%22'."&wt=json&facet=true&rows=200";
   
        }else{
            $resultsLink = "http://www.empireadc.org:8080/solr/eaditor-published/select?indent=on&q=". $key ."&wt=json&facet=true&facet.field=subject_facet&facet.field=agency_facet&facet.field=corpname_facet&facet.field=genreform_facet&facet.field=persname_facet&facet.field=language_facet&facet.field=century_num&facet.field=famname_facet&facet.field=geogname_facet&rows=1500";
        }
       // echo $resultsLink;
	    $json = file_get_contents($resultsLink);
        $data['key'] = $key;
        $data['facet'] = $facet;
        $data['results'] = json_decode($json);

        // Facet labels to be displayed in the search UI.
        $data['facetsLabels'] = array("subject", "agency", "organization", "genre/format", "person", "language", "date", "place");
        //Original facet labels retrieved from solr api.
        $data['facetsOrgLabels'] = array("subject_facet", "agency_facet", "corpname_facet", "genreform_facet", "persname_facet", "language_facet", "century_num", "geogname_facet");
       //Multi dimensional super array that will hold sub arrays for each facets.
        $facetsList = array();
        $cnt = 0;

        //Loop for each facet from $facetsOrgLabels array.
        foreach ($data['facetsOrgLabels'] as $list){
            //Array created to hold the values of each facet.
            $valuesList = array();
            //Loop each record.
            foreach ($data['results']->response->docs as $row) {
               //Check if the current selected facet is available for the current selected record.
                if(isset($row->$list)){
                    $rowValues = (array)$row->$list;
                    foreach($rowValues as $key => $value){
                        if (in_array($value, $valuesList)){
                            // Ignore if already present in the array.
                        }else{
                            array_push($valuesList, $value);
                            sort($valuesList);
                        }                        
                    }
                }
            } 
            
            //Once the values of the selected facet is loaded onto the $values array, $value array is next loaded onto the $facetList super array.
            $facetsList[$cnt][0] = $valuesList;
           //Counter is updated by one for the next facet label from $facetsOrgLabels array.
            $cnt++ ;
        }

        //Send the super array to the search UI for display.
        $data['facetsList'] = $facetsList;
        $this->load->view('results', $data);
     }

     public function searchAll()
     {
        $resultsLink = "http://www.empireadc.org:8080/solr/eaditor-published/select?indent=on&q=*:*&wt=json&facet=true&facet.field=subject_facet&facet.field=agency_facet&facet.field=corpname_facet&facet.field=genreform_facet&facet.field=persname_facet&facet.field=language_facet&facet.field=century_num&facet.field=famname_facet&facet.field=geogname_facet&rows=1500";
        $json = file_get_contents($resultsLink);
        $data['results'] = json_decode($json);

        // Facet labels to be displayed in the search UI.
        $data['facetsLabels'] = array("subject", "agency", "organization", "genre/format", "person", "language", "date", "place");
        //Original facet labels retrieved from solr api.
        $data['facetsOrgLabels'] = array("subject_facet", "agency_facet", "corpname_facet", "genreform_facet", "persname_facet", "language_facet", "century_num", "geogname_facet");
       //Multi dimensional super array that will hold sub arrays for each facets.
        $facetsList = array();
        $cnt = 0;

        //Loop for each facet from $facetsOrgLabels array.
        foreach ($data['facetsOrgLabels'] as $list){
            //Array created to hold the values of each facet.
            $valuesList = array();
            //Loop each record.
            foreach ($data['results']->response->docs as $row) {
               //Check if the current selected facet is available for the current selected record.
                if(isset($row->$list)){
                    $rowValues = (array)$row->$list;
                    foreach($rowValues as $key => $value){
                        if (in_array($value, $valuesList)){
                            // Ignore if already present in the array.
                        }else{
                            array_push($valuesList, $value);
                            sort($valuesList);
                        }                        
                    }
                }
            } 
            
            //Once the values of the selected facet is loaded onto the $values array, $value array is next loaded onto the $facetList super array.
            $facetsList[$cnt][0] = $valuesList;
           //Counter is updated by one for the next facet label from $facetsOrgLabels array.
            $cnt++ ;
        }

        //Send the super array to the search UI for display.
        $data['facetsList'] = $facetsList;


        $this->load->view('results', $data);
      }
	
     public function ead($collId, $eadId)
	{
        $data['collId'] = $collId;
        $data['eadId'] = $eadId;
        $this->load->view('ead_view', $data);
     }

     public function browse()
     {
        $resultsLink = "http://www.empireadc.org:8080/solr/eaditor-published/select?indent=on&q=*:*&wt=json&facet=true&facet.field=agency_facet";
        $json = file_get_contents($resultsLink);
        $data['results'] = json_decode($json);
        $this->load->view('browse', $data);
     }

     public function agency($key){ 
        $data['key'] = $key ;
        $data['facet'] = 'agency_facet';
        $this->load->view('search', $data);
     }

    
    /* public function agencyEADs($agencyKey){
        $agencyKey = trim($agencyKey);
        $agencyKey = str_replace("%2520","%20", $agencyKey);
        $agencyKey = str_replace("fq%3D","&fq=", $agencyKey);
        $agencyKey = str_replace("%252C","%2C", $agencyKey);
        $resultsLink = "http://www.empireadc.org:8080/solr/eaditor-published/select?indent=on&q=*:*&fq=agency_facet".'%3A%22'. $agencyKey .'%22'."&wt=json&facet=true&facet.field=subject_facet&facet.field=agency_facet&facet.field=corpname_facet&facet.field=genreform_facet&facet.field=persname_facet&facet.field=language_facet&facet.field=century_num&facet.field=famname_facet&facet.field=geogname_facet&rows=200";
       // echo $resultsLink;
	    $json = file_get_contents($resultsLink);
        //$data['key'] = $key;
        //$data['facet'] = $subject_facet;
        $data['results'] = json_decode($json);
        $this->load->view('results', $data);
     }

   


  /*   public function reserve(){
         $this->load->view('reserve');
     }

   public function sendEmail(){
       $cart_items = json_decode($_POST['final_cart'], true);
       $user =$_POST["firstName"]." ".$_POST["lastName"];

       $emailId = $_POST["emailId"];
       if($_POST["message"]!= null) {
           $user_message = $_POST["message"];
       }else{
           $user_message = "";

       }
       $message = '<html><body>';

       $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';

       $message .= '<tr><td align="center"><img src="https://www.empireadc.org/sites/www.empireadc.org/files/ead_logo.gif" /><h3>Research Request </h3>';

       $message .= "<br/><br/><h4 align='left'>Dear $user,</h4> <h4><br/> Thank you for your request. We've received your finalized cart. We will review it and get back to you soon. Please let us know if there are any changes required to your finalized cart.</h4><br/></br/><h4 align='left' style='font-style: italic'>Thanks & Regards,</h4><h4 align='left' style='font-style: italic'>Empire Archival Discovery Co-Operative.</h4></td></tr>";

       $message .= "<tr><td><h3>Your Finalized Cart:</h3></br></br>" ;
       $message .= '<table width="80%"; rules="all" style="border:1px solid #3A5896;" align="center" cellpadding="10">';
       for($i=0;$i<sizeof($cart_items);$i++){
           $Sno = $i+1;
           $message .=  "<tr><td>$Sno</td><td>".urldecode($cart_items[$i])."</td></tr>";
       };
       $message .= "</table></br></td></tr><tr><td><h3>Your Message:</h3></br>$user_message</h3></td></tr></table>";
       $message .= "</body></html>";
       $ci = get_instance();
       $ci->load->library('email');
       $config['protocol'] = "smtp";
       $config['smtp_host'] = "tls://smtp.googlemail.com";
       $config['smtp_port'] = "465";
       $config['smtp_user'] = "***************REUQIRED VALUE****************";
       $config['smtp_pass'] = "***************REQUIRED VALUE****************";
       $config['charset'] = "utf-8";
       $config['mailtype'] = "html";
       $config['newline'] = "\r\n";
       $ci->email->initialize($config);
       $ci->email->from('empireadc@gmail.com', "Empire ADC");
       $ci->email->cc('empireadc@gmail.com');
       $ci->email->to($emailId);
       $ci->email->reply_to('empireadc@gmail.com', "Empite ADC");
       $ci->email->message($message);
       $ci->email->subject("EADC research request");
       if($ci->email->send()){
           echo 1;
       }else{
           echo 0;
       }
   }*/
}
?>
