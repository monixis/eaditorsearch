<?php
class eaditorsearch extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function test($val)
    {
        $date = date_default_timezone_set('US/Eastern');
        echo $val;
    }

    public function index()
    {
        $date = date_default_timezone_set('US/Eastern');

        if ($this -> input -> get('key')) {
            $data["key"] = $this -> input -> get('key');
        } else {
            $data["key"] = "";
        }

        if ($this -> input -> get('facet')) {
            $data["facet"] = $this -> input -> get('facet');
        } else {
            $data["facet"]="";
        }
        $this->load->view('search', $data);
    }
    public function searchKeyWords($key, $facet)
    {
        $key = trim($key);
        $key = str_replace("%20", "+", $key);
        $key = str_replace("%2520", "+", $key);
        $key = str_replace("fq%3D", "&fq=", $key);
        $key = str_replace("%2C", "%2C", $key);
        $key = str_replace("&#40;", "%28", $key);
        $key = str_replace("&#41;", "%29", $key);
        $key = str_replace("%2527", "'", $key);
        $key = str_replace("%252C", ",", $key);

        if ($facet != "NULL") {
            $resultsLink = "http://www.empireadc.org:8080/solr/eaditor-published/select?indent=on&q=*:*&fq=".$facet.'%3A%22'. $key .'%22'."&wt=json&facet=true&facet.field=subject_facet&facet.field=agency_facet&facet.field=corpname_facet&facet.field=genreform_facet&facet.field=persname_facet&facet.field=language_facet&facet.field=century_num&facet.field=famname_facet&facet.field=geogname_facet&rows=1500";
        //$resultsLink = "http://www.empireadc.org:8080/solr/eaditor-published/select?indent=on&q=*:*&fq=".$facet.'%3A%22'. $key .'%22'."&wt=json&facet=true&rows=200";
        } else {
            $resultsLink = "http://www.empireadc.org:8080/solr/eaditor-published/select?indent=on&q=". $key ."&wt=json&facet=true&facet.field=subject_facet&facet.field=agency_facet&facet.field=corpname_facet&facet.field=genreform_facet&facet.field=persname_facet&facet.field=language_facet&facet.field=century_num&facet.field=famname_facet&facet.field=geogname_facet&rows=1500";
        }
        //echo $resultsLink;
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
        foreach ($data['facetsOrgLabels'] as $list) {
            //Array created to hold the values of each facet.
            $valuesList = array();
            //Loop each record.
            foreach ($data['results']->response->docs as $row) {
                //Check if the current selected facet is available for the current selected record.
                if (isset($row->$list)) {
                    $rowValues = (array)$row->$list;
                    foreach ($rowValues as $key => $value) {
                        if (in_array($value, $valuesList)) {
                            // Ignore if already present in the array.
                        } else {
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
        // echo $resultsLink;
        // Facet labels to be displayed in the search UI.
        $data['facetsLabels'] = array("subject", "agency", "organization", "genre/format", "person", "language", "date", "place");
        //Original facet labels retrieved from solr api.
        $data['facetsOrgLabels'] = array("subject_facet", "agency_facet", "corpname_facet", "genreform_facet", "persname_facet", "language_facet", "century_num", "geogname_facet");
        //Multi dimensional super array that will hold sub arrays for each facets.
        $facetsList = array();
        $cnt = 0;

        //Loop for each facet from $facetsOrgLabels array.
        foreach ($data['facetsOrgLabels'] as $list) {
            //Array created to hold the values of each facet.
            $valuesList = array();
            //Loop each record.
            foreach ($data['results']->response->docs as $row) {
                //Check if the current selected facet is available for the current selected record.
                if (isset($row->$list)) {
                    $rowValues = (array)$row->$list;
                    foreach ($rowValues as $key => $value) {
                        if (in_array($value, $valuesList)) {
                            // Ignore if already present in the array.
                        } else {
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

    public function agency($key)
    {
        $data['key'] = $key ;
        $data['facet'] = 'agency_facet';
        $this->load->view('search', $data);
    }
}
