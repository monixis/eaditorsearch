<?php
class eaditorSearch extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();

    }


    public function index()
    {
        $date = date_default_timezone_set('US/Eastern');
       // $this->load->model('repository_model');
        //$data['keywords'] = $this->repository_model->getKeywords();
        //$data["searchString"] = "";
        $this->load->view('search');
    }
       
  public function searchKeyWords()
	{
        $key = $this -> input -> get('key');
        $key = trim($key);
        $key = str_replace(" ","%20", $key);
		$key = str_replace("fq","&fq", $key);
            // $resultsLink = "http://www.empireadc.org:8080/solr/eaditor-published/select?q=".$key."&wt=json";
        $resultsLink = "http://www.empireadc.org:8080/solr/eaditor-published/select?indent=on&q=". $key ."&wt=json&facet=true&facet.field=subject_facet&facet.field=agency_facet&facet.field=corpname_facet&facet.field=genreform_facet&facet.field=persname_facet&facet.field=language_facet&facet.field=century_num&facet.field=famname_facet&facet.field=geogname_facet&rows=200";
        $json = file_get_contents($resultsLink);
        $data['results'] = json_decode($json);
		//$data['searchTerm'] = $key;
        $this->load->view('results', $data);
     }

     public function viewEAD()
	{
        $data['collId'] = $this->input->get('collId');
        $data['eadId'] = $this->input->get('eadId');
        $this->load->view('ead_view', $data);
     }
}
?>
