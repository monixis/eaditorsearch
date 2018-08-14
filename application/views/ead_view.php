<!DOCTYPE html>
<html lang="en">
<head prefix="dcterms: http://purl.org/dc/terms/">
  <title>EADitor EAD view</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
  <!--link rel="stylesheet" href="styles/bootstrap.css"-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
  <!--EmpireADC Drupal CSS -->
  <link href="http://empireadc.local/sites/empireadc.local/themes/esln_ead/css/style.css" rel="stylesheet">
  <link href="http://empireadc.local/sites/empireadc.local/themes/esln_ead/css/media.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("/styles/main.css"); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("/styles/chronlogy.css"); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("/styles/768.css"); ?>"/>
  <style>
    ul{list-style-type:none;}
    li.Subseries{margin-left: 20px;}
     #tocResponsive {
        display: none;
      }
    @media only screen and (max-width: 600px) {
      #toc {
        visibility: hidden;
      }
      #tocResponsive {
        display:block;
        margin-top: 30px;
      }
    }
  </style>

  <?php
    $this->load->helper('url');
    #$link = "https://www.empireadc.org/ead/". strtolower($collId) ."/id/".$eadId.".xml";
    #Link directly to exist to help with large size xml
    $link ="http://www.empireadc.org:8080/exist/rest/db/eaditor/". strtolower($collId) ."/guides/".$eadId.".xml";
    $rdf = "https://www.empireadc.org/ead/". $collId ."/id/".$eadId.".rdf";
    $is_chron_available = false;

    $GLOBALS['tree'] = ' ';
    $reader = new XMLReader();
    $reader->open($link);
    while ($reader -> read()) {
        if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'ead') {
            $doc = new DOMDocument('1.0', 'UTF-8');
            $xml = simplexml_import_dom($doc->importNode($reader->expand(), true));

            $title = $xml->archdesc->did->unittitle;
            $repository = (isset($xml->archdesc->did->repository->corpname)? $xml->archdesc->did->repository->corpname : $xml->archdesc->did->repository);
            $subarea = (isset($xml->archdesc->did->repository->subarea)? $xml->archdesc->did->repository->subarea : $xml->archdesc->did->subarea);
            $rURL = " ";
            $repo = (isset($xml->archdesc->did->repository->extptr)? true : false);
            if ($repo == true) {
                $repo = $xml->archdesc->did->repository->extptr;
                $repoAttr = $repo ->  attributes('http://www.w3.org/1999/xlink');
                $rURL = $repoAttr['href'];
            }

            $addressline = array();
            $address = (isset($xml->archdesc->did->repository->address)? true : false);
            if ($address == true) {
                foreach ($xml->archdesc->did->repository->address->addressline as $a) {
                    array_push($addressline, $a);
                }
            }
            $extent = (isset($xml->archdesc->did->physdesc->extent)? $xml->archdesc->did->physdesc->extent : 'Unspecified');

            $creatorList = array();
            $cnt =  0;
            $x = 0;
            $creator =  (isset($xml->archdesc->did->origination)? true : false);
            if ($creator != false) {
                foreach ($xml->archdesc->did->origination as $c) {
                    if ($c->children()->getname() == 'persname') {
                        // array_push($creatorList, $c->persname);
                        $creatorList[$x][0] = $c->persname;
                        $creatorList[$x][1] = "persname_facet";
                        $x++;
                    } elseif ($c->children()->getname() == 'famname') {
                        //array_push($creatorList, $c->famname);
                        $creatorList[$x][0] = $c->famname;
                        $creatorList[$x][1] = "famname_facet";
                        $x++;
                    } elseif ($c->children()->getname() == 'corpname') {
                        //array_push($creatorList, $c->corpname);
                        $creatorList[$x][0] = $c->corpname;
                        $creatorList[$x][1] = "corpname_facet";
                        $x++;
                    }
                }
            }

            $location = (isset($xml->archdesc->did->physloc)? $xml->archdesc->did->physloc : 'Unspecified');

            $languageList = array();
            $multiLanguage = (isset($xml->archdesc->did->langmaterial-> language)? $xml->archdesc->did->langmaterial-> language : false);
            if ($multiLanguage == false) {
                array_push($languageList, $xml->archdesc->did->langmaterial);
            } elseif ($multiLanguage != false) {
                foreach ($xml->archdesc->did->langmaterial->language as $lang) {
                    array_push($languageList, $lang);
                }
            }

            $abstract = (isset($xml->archdesc->did->abstract)? $xml->archdesc->did->abstract : 'Unspecified');
            if ($abstract != 'Unspecified') {
                foreach ($xml->archdesc->did->abstract as $a) {
                    if ($a->getname() == 'abstract') {
                        $abstract = $a . "<br />\n" ;
                    }
                }
            }

            $processInfo = (isset($xml->archdesc->processinfo->p)? $xml->archdesc->processinfo->p : 'Unspecified');

            $prefercite = (isset($xml->archdesc->prefercite->p)?  $xml->archdesc->prefercite->p : 'Unspecified');
            if ($prefercite != 'Unspecified') {
                foreach ($xml->archdesc->prefercite->children() as $p) {
                    if ($p->getname() == 'p') {
                        $prefercite = $prefercite . $p . "<br />\n" ;
                    }
                }
            }

            $access = (isset($xml->archdesc->accessrestrict)? $xml->archdesc->accessrestrict : 'Unspecified');
            if ($access != 'Unspecified') {
                foreach ($xml->archdesc->accessrestrict->children() as $p) {
                    if ($p->getname() == 'p') {
                        $access = $access . $p . "<br />\n" ;
                    }
                }
            }

            $copyright = (isset($xml->archdesc->userestrict->p)? $xml->archdesc->userestrict->p : 'Unspecified');

            $acqInfo = (isset($xml->archdesc->descgrp->acqinfo)? $xml->archdesc->descgrp->acqinfo : 'Unspecified');
            if ($acqInfo != 'Unspecified') {
                foreach ($xml->archdesc->descgrp->acqinfo->children() as $p) {
                    if ($p->getname() == 'p') {
                        $acqInfo = $acqInfo . $p . "<br />\n" ;
                    }
                }
            }

            $accruals  = (isset($xml->archdesc->descgrp->accruals)? $xml->archdesc->descgrp->accruals : 'Unspecified');
            if ($accruals != 'Unspecified') {
                foreach ($xml->archdesc->descgrp->accruals->children() as $p) {
                    if ($p->getname() == 'p') {
                        $accruals = $accruals . $p . "<br />\n" ;
                    }
                }
            }

            $prefCitation = (isset($xml->archdesc->prefercite->p[1])? $xml->archdesc->prefercite->p[1] : 'Unspecified');

            $histNote = (isset($xml->archdesc->bioghist)? $xml->archdesc->bioghist : 'Unspecified');
            if ($histNote != 'Unspecified') {
                $chronList = array();
                foreach ($xml->archdesc->bioghist->children() as $p) {
                    if ($p->getname() == 'p') {
                        $histNote = $histNote . $p . "<br /><br />\n" ;
                    } elseif ($p ->getname() == 'chronlist') {
                        $is_chron_available = true;
                    }
                }
            }

            $scopeContent = (isset($xml->archdesc->scopecontent)? $xml->archdesc->scopecontent : 'Unspecified');
            if ($scopeContent != 'Unspecified') {
                foreach ($xml->archdesc->scopecontent->children() as $p) {
                    if ($p->getname() == 'p') {
                        $scopeContent = $scopeContent  . $p . "<br /><br />\n" ;
                    } elseif ($p->getname() == 'list') {
                        foreach ($xml->archdesc->scopecontent->list->children() as $c) {
                            if ($c -> getname() == 'head') {
                                $scopeContent = $scopeContent . "<h4>" . $c . "</h4>";
                            } else {
                                $scopeContent = $scopeContent . $c . "<br />";
                            }
                        }
                    }
                }
            }

            $arrangement = (isset($xml->archdesc->arrangement)? $xml->archdesc->arrangement : 'Unspecified');
            if ($arrangement != 'Unspecified') {
                foreach ($xml->archdesc->arrangement->children() as $p) {
                    if ($p->getname() == 'p') {
                        $arrangement = $arrangement . $p . "<br />\n" ;
                        $arrangementlist = (isset($p->list)? $p->list : 'Unspecified');
                        if ($arrangementlist != 'Unspecified') {
                            $arrangementlist = array();
                            foreach ($p->list->item as $child) {
                                array_push($arrangementlist, $child->ref);
                            }
                        }
                    }
                }
            }


            // $relatedMaterialList = array();
            $relatedMaterialLink = array();
            $relatedMaterial = (isset($xml->archdesc->relatedmaterial)? true : false);
            if ($relatedMaterial == true) {
                $relatedMaterialChild = (isset($xml->archdesc->relatedmaterial->p->extref)? true : false);
                if ($relatedMaterialChild == true) {
                    $linksAvailable = true;
                    $i = 0;
                    foreach ($xml->archdesc->relatedmaterial->p->extref as $rm) {
                        $rmLinkAttr = $rm -> attributes('http://www.w3.org/1999/xlink');
                        $rmLink = $rmLinkAttr['href'];
                        $relatedMaterialLink[$i][0] = $rm;
                        $relatedMaterialLink[$i][1] = $rmLink;
                        $i = $i + 1;
                    }
                } else { //to deal with two variations in relatedmaterial encoding
                    $linksAvailable = false;
                    $i = 0;
                    foreach ($xml->archdesc->relatedmaterial->p as $rm) {
                        $relatedMaterialLink[$i][0] = $rm;
                        $i = $i + 1;
                    }
                }
            }

            $seperateMaterial = (isset($xml->archdesc->separatedmaterial)? $xml->archdesc->separatedmaterial : 'Unspecified');
            if ($seperateMaterial != 'Unspecified') {
                foreach ($xml->archdesc->separatedmaterial->children() as $p) {
                    if ($p->getname() == 'p') {
                        $seperateMaterial  = $seperateMaterial  . $p . "<br />\n" ;
                    }
                }
            }

            $componentList = (isset($xml->archdesc->dsc->c)? true : false);
            $digitalObject = (isset($xml->archdesc->did->daogrp)? true : false);
            $otherfindaids = (isset($xml->archdesc->otherfindaid->bibref->extptr)? $xml->archdesc->otherfindaid->bibref->extptr : false);
            if ($otherfindaids != false) {
                $otherfindaidsAttr = $otherfindaids -> attributes('http://www.w3.org/1999/xlink');
                $filename = $otherfindaidsAttr['href'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $iconLink = 'https://www.empireadc.org/ead/ui/images/';
                if ($ext == 'docx') {
                    $iconLink = $iconLink . 'word.png';
                } elseif ($ext == 'pdf') {
                    $iconLink = $iconLink . 'adobe.png';
                } elseif ($ext == 'xlsx') {
                    $iconLink = $iconLink . 'excel.png';
                }
                $downloadLink = "https://www.empireadc.org/ead/uploads/". $collId ."/".$otherfindaidsAttr['href'];
            }
            $dateRange = array();
            foreach ($xml->archdesc->did->unitdate as $x) {
                $dateValue = ucfirst($x['type']). ' Date: '.$x ;
                array_push($dateRange, $dateValue);
            }
        }
    } //while ends

    ?>

    <style>
        .p-list {
            list-style:disc outside none;
            display:list-item;
        }
    </style>
</head>
<body>

<?php

    function seriesLevel($level, $obj, $collId, $repository)
    { //recursive function that creates placeholder for series and other sub levels
        $flag = 0;
        $component = 0;
        $fileLevel = 0;
        $titleInfo = ' '; ?>
		<div class="<?php echo $level; ?> seriesRow">
					<?php
              foreach ($obj->did->children() as $childObj) {
                  if ($childObj->getname() == 'unittitle') {
                      if (count($childObj) > 0) {
                          ?>
            						<!--h4><?php echo $childObj->title; ?></h4>
                				<h4><?php echo $childObj->title->emph; ?></h4-->
                        <h4 id = <?php echo ucfirst($level) . $obj->did->unitid; ?> ><?php echo ucfirst($level) . " " . $obj->did->unitid . ": " . $childObj->title . $childObj->title->emph . $childObj->emph; ?></h4>
           						<?php
                      } else {
                          ?>
           							<h4 id = <?php echo ucfirst($level) . $obj->did->unitid; ?> ><?php echo ucfirst($level) . " " . $obj->did->unitid . ": " . $childObj; ?></h4>
           						<?php
                      }
                  } elseif ($childObj->getname() == 'unitdate') {
                      ?>
          						<p><?php echo ucfirst($childObj['type']).' Date: '.$childObj; ?></p><?php
                  } elseif ($childObj->getname() == 'container') {
                      ?>
          						<p><?php echo ucfirst($childObj['type']).": ". $childObj; ?></p><?php
                  } ?>
          			<?php
              } ?>
          			<p style="line-height: 24px;"><?php echo isset($obj->scopecontent->p)?$obj->scopecontent->p : '' ; ?></p>

                <?php
                  if ($obj->did->unittitle != '') {
                      $titleInfo = $obj->did->unittitle;
                  } else {
                      $titleInfo = $obj->did->unittitle->emph;
                  }
        $GLOBALS['tree'] = $GLOBALS['tree'] . '<li class="'. ucfirst($level) . '"><a href="' . '#' . ucfirst($level) . $obj->did->unitid . '"' . ' class="tocLink">' .  ucfirst($level) . " " . $obj->did->unitid . ": " . $obj->did->unittitle . $obj->did->unittitle->emph . '</a></li>';
        $GLOBALS['tree'] = str_replace("'", "&#039;", $GLOBALS['tree']); ?>

          			<!-- Check if this series has children levels -->
          			<?php
                      foreach ($obj->children() as $grandchildObj) {
                          if ($grandchildObj->getname() == 'c') {
                              $cAttr1 = $grandchildObj->attributes();

                              $cLevel1 = $cAttr1["level"];

                              if ($cLevel1 == 'otherlevel' || $cLevel1 == 'subseries' || $cLevel1 == 'series') {
                                  $flag = 1;
                                  seriesLevel($cLevel1, $grandchildObj, $collId, $repository);
                              } elseif ($cLevel1 == 'file') {
                                  $fileLevel = 1;
                              } else {
                                  $fileLevel = 1 ;
                              }
                          }
                      }
        if ($flag == 0) { // if no other level exists, display the files
            if ($fileLevel == 1) {
                ?>

              	<button type="button" class="btn btn-custm" data-toggle="collapse" data-target="#<?php echo $obj['id']; ?>" style="margin-bottom: 5px; text-decoration: none; color: #fff;">View the files.</button>
                <div id="<?php echo $obj['id']; ?>" class="collapse" style="width: 75%; border-left: 1px solid #ccc; border-right: 1px solid #ccc; margin-left:auto; margin-right: auto;">
								<?php
                                    foreach ($obj->c as $fileObj) {
                                        ?>
										<div class="fileRow">
											<?php
                                                foreach ($fileObj->children() as $c) {
                                                    if ($c->getname() == 'did') {
                                                        foreach ($fileObj->did->children() as $file) {
                                                            if ($file->getname() == 'unittitle') {
                                                                if (count($file) > 0) {
                                                                    ?>
                                     <h4><?php echo $file->title;
                                                                    $component = $file->title; ?></h4>
                                     <h4><?php echo $file->emph; ?><?php	echo $file; ?></h4>
                                    <?php
                                                                } else {
                                                                    ?>
                                      <h4><?php	echo $file;
                                                                    $component = $file; ?></h4>
                                    <?php
                                                                }
                                                            } elseif ($file->getname() == 'unitdate') {
                                                                ?>
                                   <p><?php echo ucfirst($file['type']).' Date: '.$file; ?></p><?php
                                                            } elseif ($file->getname() == 'container') {
                                                                ?>
                                  <p><?php echo ucfirst($file['type']).": ". $file;
                                                                $arr = explode(' ', ucfirst($file['type'])."-". $file);
                                                                $component = $component."-". $arr[0]; ?></p><?php
                                                            } ?><!--   <input type="checkbox" class="big-checkbox" id="<?php echo  "crtitm"."-".$collId."-".$component; ?>" value="<?php echo  $repository.substr(0, 13)."..."."-".$collId."-".$component; ?>">--><?php
                                                        }
                                                    } elseif ($c->getname() == 'scopecontent') {
                                                        ?><h4>Scope and Content</h4><?php
                              foreach ($fileObj->scopecontent->p as $p) {
                                  ?>
                                  <p style="line-height: 1.6"><?php echo $p; ?></p>
                          <?php
                              }
                                                    }
                                                } ?>
                    </div>
								<?php
                                    } ?>
						</div>
                <?php
            } ?>
					<?php
        } ?>
          </div>
<?php
    }
?>




      <div class="senylrc_top_container" style="margin-left:16%;">
         <div class="top_left">
                   <div id="logo">
               <a href="/" title="Home"><img src="http://empireadc.local/sites\empireadc.org\files/ead_logo.gif"/></a>
             </div>

           <h1 id="site-title">
             <a href="/" title="Home"></a>

           </h1>
         </div>

         <div class="top_right">
      <div id="site-description">Finding Aids at Your Fingertips</div>
           <nav id="main-menu"  role="navigation">
             <a class="nav-toggle" href="#">Menu</a>
             <div class="menu-navigation-container">
               <ul class="menu"><li class="first leaf"><a href="http://empireadc.local/empiresearch/eaditorsearch/browse" title="">Browse</a></li>
     <li class="leaf"><a href="http://empireadc.local/empiresearch/" title="">Search</a></li>
     <li class="leaf"><a href="/participate">Participate</a></li>
     <li class="last leaf"><a href="/about">About</a></li>
     </ul>        </div>

             <div class="clear"></div>
           </nav>
         </div>
      </div>
         <div class="clear"></div>





<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">

    </div>
    <div class="col-sm-8 text-left">
    <div class="reptitle"><h1><span property="dcterms:title"><?php echo $title; ?></span></h1></div>
     <div id="tocResponsive"></div>
     <div id="eadInfo" style="margin-bottom: 30px;">

       <!--if($eadId == TRUE){ ?>
          <label>EAD Id:</label><p><span property="dcterms:identifier"><!--?php echo $eadId; ?></span></p>
       <--?php } */?> -->

       <label>Repository:</label><a class="searchTerm" style="font-style: italic" href="#"><p style="width: 230px;"><?php echo $repository; ?></a><br><?php echo $subarea; ?></p>

       <?php if ($address == true) {
    foreach ($addressline as $a) {
        ?>
            <h5 style="font-style: italic"><?php echo $a; ?></h5>
       <?php
    }
}
      #Check if URL is missing the http and add it if is missing
       $add= strpos($rURL, 'http://') !== false ? '' : 'http://';
       $add .=$rURL;
       ?>
       <h5><a href='<?php echo $add; ?>' style='font-size: 15px' ><?php echo $rURL; ?></a></h5>

       <label>Dates: </label>
       <?php
       foreach ($dateRange as $y) {
           ?>
          <p><?php echo $y; ?></p>
      <?php
       } ?>

      <label>Creator: </label>
      <!--?php foreach ($creatorList as $c){ ?>
            <p><span property="dcterms:creator"><a href="#" id="<?php echo $c[0][1]; ?>" class="controlledHeader"><?php echo $c[0][0]; ?></a></span></p>
      <!--?php } -->

      <?php for ($y = 0 ; $y < count($creatorList) ; $y++) {
           ?>
            <p><span property="dcterms:creator"><a href="#" id="<?php echo $creatorList[$y][1]; ?>" class="controlledHeader"><?php echo $creatorList[$y][0]; ?></a></span></p>
      <?php
       }

      if ($extent != 'Unspecified') {
          foreach ($extent as $y) {
              ?>
          <label>Size: </label><p><span property="dcterms:extent"><?php echo $y; ?></span></p>
        <?php
          }
      } ?>

        <label>Language: </label>

      <?php foreach ($languageList as $l) {
          ?>
         <p><?php echo $l; ?></p>
      <?php
      } ?>

      <?php if ($abstract != 'Unspecified') {
          ?>
        <label>Abstract:</label><p><span property="dcterms:abstract"><?php echo auto_link($abstract, 'both', true); ?></span></p>
      <?php
      } ?>

  </div>
  <button type="button" onclick="expand()">Expand All</button>&nbsp&nbsp&nbsp&nbsp
  <button type="button" onclick="collapse()">Collapse All</button>
<h4 data-toggle="collapse" data-target="#descId" class='infoAccordion accordion'>Collection Details<span class="glyphicon glyphicon-menu-right" style="float:right;"></span></h4>
<div id="descId" class="collapse">
        <?php if ($processInfo != 'Unspecified') {
          ?>
          <label>Processing Information: </label><p><?php echo auto_link($processInfo, 'both', true); ?></p>
        <?php
      }

        if ($acqInfo != 'Unspecified') {
            ?>
          <label>Acquisition Information: </label><p><?php echo auto_link($acqInfo, 'both', true); ?></p>
        <?php
        }

        if ($location != 'Unspecified') {
            ?>
          <label>Location: </label><p><?php echo $location; ?></p>
        <?php
        }

        if ($histNote != 'Unspecified') {
            ?>
          <label>Historical Note: </label><p><?php echo auto_link($histNote, 'both', true); ?></p>
        <?php
        }

        if ($scopeContent != 'Unspecified') {
            ?>
          <label>Scope and Content: </label><p><?php echo auto_link($scopeContent, 'both', true); ?></p>
        <?php
        }

        if ($arrangement != 'Unspecified') {
            ?>
          <label>Arrangement: </label><p><?php echo auto_link($arrangement, 'both', true); ?></p>
          <ul>
            <?php  if ($arrangementlist != 'Unspecified') {
                foreach ($arrangementlist as $listitem) {
                    echo "<li>$listitem</li>";
                }
            } ?>
            </ul>
        <?php
        }

        if ($seperateMaterial != 'Unspecified') {
            ?>
          <label>Separated Material: </label><p><?php echo auto_link($seperateMaterial, 'both', true); ?></p>
        <?php
        }

        if ($relatedMaterial == true) {
            ?>
          <label>Related Materials: </label><br/>
          <?php for ($i=0 ; $i < sizeof($relatedMaterialLink) ; $i ++) {
                if ($linksAvailable == true) {
                    ?>
            <a href='<?php $relatedMaterialLink[$i][1]; ?>' ><?php echo $relatedMaterialLink[$i][0]; ?></a></br>
          <?php
                } else {
                    ?>
            <a style='pointer-events: none; color: #000000;'><?php echo $relatedMaterialLink[$i][0]; ?></a></br>
          <?php
                }
            }
        }

        if ($accruals != 'Unspecified') {
            ?>
          <label>Accruals and Additions: </label><p><?php echo auto_link($accruals, 'both', true); ?></p>
        <?php
        } ?>
</div>

<h4 data-toggle="collapse" data-target="#adminInfo" class='infoAccordion accordion'>Collection Access &amp; Use<span class="glyphicon glyphicon-menu-right" style="float:right;"></span></h4>
<div id="adminInfo" class="collapse">
        <?php
        if ($access != 'Unspecified') {
            ?>
          <label>Access: </label><p><?php echo auto_link($access, 'both', true); ?></p>
        <?php
        }
        if ($copyright != 'Unspecified') {
            ?>
          <label>Copyright: </label><p><?php echo auto_link($copyright, 'both', true); ?></p>
        <?php
        }
        if ($prefercite != 'Unspecified') {
            ?>
          <label>Preferred Citation: </label><p><?php echo auto_link($prefercite, 'both', true); ?></p>
        <?php
        } ?>
</div>

<h4 data-toggle="collapse" data-target="#controlHeadings" class='infoAccordion accordion'>Collection Subjects &amp; Formats<span class="glyphicon glyphicon-menu-right" style="float:right;"></span></h4>
<div id="controlHeadings" class="collapse">
         <?php
         $controlledAccess = (isset($xml->archdesc->controlaccess)? true : false);

         if ($controlledAccess == true) {
             $controlHeading = array();
             foreach ($xml->archdesc->controlaccess->children() as $list) {
                 $included = false;
                 foreach ($controlHeading as $value) {
                     if ($value == $list->getname()) {
                         $included = true;
                     }
                 }
                 if ($included == false) {
                     array_push($controlHeading, $list->getname());
                 }
             }
             foreach ($controlHeading as $value) {
                 $headValue = $value;
                 if ($value == 'subject') {
                     $headValue = 'Subject:';
                 } elseif ($value == 'persname') {
                     $headValue = 'Person:';
                 } elseif ($value == 'genreform') {
                     $headValue = 'Genre/Format:';
                 } elseif ($value == 'corpname') {
                     $headValue = 'Corporation:';
                 } elseif ($value == 'geogname') {
                     $headValue = 'Place:';
                 } ?>
           <?php
            if ($value == 'geogname') {  #Get the list of locations so we can add a coverage filed?>
             <h5><?php echo $headValue; ?></h5>
            <?php  foreach ($xml->archdesc->controlaccess->children() as $list) {
                if ($value == $list->getname()) {
                    ?>
                    <ul style='font-size:15px;'><li><a href="#" id="geogname_facet"class='controlledHeader' ><span property="dcterms:coverage"><?php echo $list; ?></span></a></li></ul>
            <?php
                } #End if statement
            }  #End Foreach loop
            } elseif ($value == 'subject') { #Output rest of control Headings
                ?>
                <h5><?php echo $headValue; ?></h5>
                <?php  foreach ($xml->archdesc->controlaccess->children() as $list) {
                    if ($value == $list->getname()) {
                        ?>
                        <ul><li><a href="#" id="subject_facet" class='controlledHeader' <span property="dcterms:subject"><?php echo $list; ?></span></a></li></ul>
                    <?php
                    }#End of statment
                } #End foreach loop
            } elseif ($value == 'persname') { #Output rest of control Headings
                ?>
                <h5><?php echo $headValue; ?></h5>
                <?php  foreach ($xml->archdesc->controlaccess->children() as $list) {
                    if ($value == $list->getname()) {
                        ?>
                        <ul><li><a href="#" id="persname_facet" class='controlledHeader' <span property="dcterms:subject"><?php echo $list; ?></span></a></li></ul>
                    <?php
                    }#End of statment
                } #End foreach loop
            } elseif ($value == 'genreform') { #Output rest of control Headings
                ?>
                <h5><?php echo $headValue; ?></h5>
                <?php  foreach ($xml->archdesc->controlaccess->children() as $list) {
                    if ($value == $list->getname()) {
                        ?>
                        <ul><li><a href="#" id="genreform_facet" class='controlledHeader' <span property="dcterms:subject"><?php echo $list; ?></span></a></li></ul>
                    <?php
                    }#End of statment
                } #End foreach loop
            } elseif ($value == 'corpname') { #Output rest of control Headings
                ?>
                <h5><?php echo $headValue; ?></h5>
                <?php  foreach ($xml->archdesc->controlaccess->children() as $list) {
                    if ($value == $list->getname()) {
                        ?>
                        <ul><li><a href="#" id="corpname_facet" class='controlledHeader' <span property="dcterms:subject"><?php echo $list; ?></span></a></li></ul>
                    <?php
                    }#End of statment
                } #End foreach loop
            }


                 # End the if statement looking for geogname
             }# End the foreach loop of controlheadings
         } else {
             ?>
            <h4 style="font-style: italic">Not available</h4>
      <?php
         }

      ?>
      </div>
<?php if ($is_chron_available) {
          ?>
  <!--button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#chronology" style="font-size: 14px;">Chronology</button-->
  <h4 data-target="#chronology" data-toggle="modal" class='infoAccordion accordion'>Chronology</h4>
<?php
      } ?>

<div id="chronology" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Chronology</h4>
      </div>
      <div class="modal-body">
      <?php if (isset($xml->archdesc->bioghist)) {
          $chronolist = 0;
          foreach ($xml->archdesc->bioghist->children() as $chron) {
              if ($chron ->getname() == 'chronlist') {
                  if ($chronolist == 0) {
                      ?>
             <button class="accordion active" id='<?php echo $chron ->head; ?>'><?php echo $chron ->head; ?></button>
               <div class="panel" style="display: block" id="<?php echo $chron ->head ; ?>">

             <?php
                  } else {
                      ?>
               <button class="accordion" id='<?php echo $chron ->head; ?>'><?php echo $chron ->head; ?></button>
                 <div class="panel" id="<?php echo $chron ->head ; ?>">

              <?php
                  } ?>

             <ul class="tl" id="<?php echo $chron ->head ; ?>">
           <?php $i= 0;
                  foreach ($xml->archdesc->bioghist->chronlist -> children() as $chronChild) {
                      if ($chronChild -> getname() =='chronitem') {
                          if ($i % 2 == 0) {
                              ?>

                   <li class='tl-inverted' id="<?php echo $chron ->head ; ?>">
                  <div class="tl-badge info"><?php echo $chronChild -> date ; ?>
                  </div><div class="tl-panel">
                  <div class="tl-body">
                               <?php if ($chronChild -> eventgrp) {
                                  foreach ($chronChild-> eventgrp -> children()  as $chronEventChild) {
                                      ?>

                                  <p class="p-list"><?php echo $chronEventChild ; ?> </p>
                          <?php
                                  } ?>
                     </div></div>

                   <?php
                              } else {
                                  ?>

                    <p><?php echo $chronChild -> event ; ?></p>
                   <?php
                              } ?>
              </li>


           <?php
                          } else {
                              ?>

                   <li class='tl' id="<?php echo $chron ->head ; ?>"><div class="tl-badge info">
                 <?php echo $chronChild -> date  ; ?></div><div class="tl-panel">
               <div class="tl-body">
               <?php if ($chronChild -> eventgrp) {
                                  foreach ($chronChild-> eventgrp -> children()  as $chronEvenChild) {
                                      ?>

                       <p class="p-list"><?php echo $chronEvenChild ; ?></p>
                    <?php
                                  } ?>
                   </div></div>

               <?php
                              } else {
                                  ?>

                   <p><?php echo $chronChild -> event ; ?></p>

                   <?php
                              } ?>
                   </li>


           <?php
                          }
                          $i++;
                      }
                  } ?>
             </ul>
           </div>

            <?php  $chronolist++ ;
              }
          }
      }?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

  </div>
    </div>
  </div>

<div id="componentList">
<?php if ($componentList == true) {
          /* For cases where high level series list exists but a more detailed container list is available for download*/
          if ($otherfindaids != false) {
              ?>
    <h4 style="margin-left:17px;">Download Container List:</h4>
    <a href='<?php echo $downloadLink; ?>' itemprop="url" style="margin-left: 17px;"><img src='<?php echo $iconLink; ?>' class="doc-icon"></a></br></br>
  <?php
          }
          $component = 0;
          foreach ($xml->archdesc->dsc->c as $c) {
              $cAttr = $c->attributes();
              $cLevel = $cAttr["level"];
              if ($cLevel == 'file' || $cLevel == 'item' || $cLevel == 'otherlevel') {
                  ?>
				<div class="fileRow">
					<?php foreach ($c->did->children() as $child) {
                      ?>

	       					<?php if ($child->getname() == 'unittitle') {
                          ?>
            					<?php if (count($child) > 0) {
                              ?>
                              <?php if (isset($child->title->emph)) {
                                  ?>

                                 <div class="fileTitle"><h4><?php echo ucfirst($cLevel).": ";
                                  $component = $child->title->emph;
                                  echo $component;
                                  $component = str_replace(" ", "", $component) ?></h4> </div>
                              <?php
                              } else {
                                  ?>
                                 <div class="fileTitle"><h4><?php echo ucfirst($cLevel).": ";
                                  $component = $child->title;
                                  echo $component;
                                  $component = str_replace(" ", "", $component)?></h4></div>
                              <?php
                              }
                          } else {
                              ?>
           							<div class="fileTitle"><h4><?php echo ucfirst($cLevel).": ";
                              $component =  $child;
                              echo $component;
                              $component = str_replace(" ", "", $component) ?></h4></div>
           						<?php
                          }
                      } elseif ($child->getname() == 'unitdate') {
                          ?>
          						<div class="fileDate"><p><?php echo ucfirst($child['type']).' Date: '.$child; ?></p></div>
                              <?php
                      } elseif ($child->getname() == 'container') {
                          ?>
          						<div class="fileContainer"><p><?php echo ucfirst($child['type']).": ". $child;
                          $arr = explode(' ', ucfirst($child['type'])."-". $child);
                          $component = $component."-". $arr[0]; ?></p></div>
                              <?php
                      }
                  } ?>
                <!--    <input type="checkbox" class="big-checkbox" id="<?php echo  "crtitm"."-".$collId."-".$component; ?>" value="<?php echo  $repository.substr(0, 13)."..."."-".$collId."-".$component; ?>">
                -->
                </div>
			<?php
              } elseif ($cLevel == 'series' || $cLevel == 'collection' || $cLevel == 'recordgrp') {
                  seriesLevel($cLevel, $c, $collId, $repository);
              }
          } /* for each */
      } elseif ($otherfindaids != false) {
          ?>
  <h4>Download Container List:</h4>
  <a href='<?php echo $downloadLink; ?>' itemprop="url"><img src='<?php echo $iconLink; ?>' class="doc-icon"></a>
<?php
      } else {
          ?>
		<h4 style="font-style: italic; margin-left: 17px;">Container List Not Available</h4>
	<?php
      }
?>
		</div><!-- componentList -->

    <!-- Dynamic table of contents based on series and subseries -->
      <?php if ($GLOBALS['tree'] != ' ') {
    ?>
        <button id="tocbutton" type="button" class="btn btn-default" style="display: hidden;">Series in this Collection:</button>
	 <div id='toc' style='position:absolute; width: 370px; height: 290px; overflow-y: auto;'>
            <label>Series in this Collection:</label>
            <?php echo '<ul id="tree">' . $GLOBALS['tree'] . '</ul>'; ?>
          </div>
      <?php
} ?>

    <h4><label>Output formats:</label></h4>
		    <a href='<?php echo $link; ?>' target='_blank' style='text-decoration: none; color: #ffffff;'><button type="button" class="btn btn-custm" >XML</button></a>
        <a href='<?php echo $rdf; ?>' target='_blank' style='text-decoration: none; color: #ffffff;'><button type="button" class="btn btn-custm" >RDF/XML</button> </a>
    </div>
     </br></br>

    <!--div id="cart" style="visibility:hidden;">
          <div align="right">
          </div>
              <table id="researchCart" class="researchCart">

      <thead>
      <tr>

          <th> <button class="btn" id="reserve"><a href="<?php echo base_url("?c=eaditorsearch&m=help");?>">Help</a></button><h4>Your Research Cart</h4></th>
          <th><button class="btn" id="reserve"><a href="<?php echo base_url("?c=eaditorsearch&m=reserve");?>">Reserve</a></button></th>
      </tr>
      <tr>
          <th>Item</th>
        <th>Remove</th>
      </tr>
      </thead>
      <tbody>
      <tr>
      </tr>
      </tbody>

    </table>x

    </div-->

	</div>
</div>

</br>
<!--footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer-->
</body>
<script>
	$('a.controlledHeader').click(function(){
      var selectedHeader = $(this).text();
      var selectedFacet = $(this).attr('id');
      var selectedHeader = selectedHeader.trim();
      var selectedHeader = selectedHeader.replace(/ /g,"%20");
      var selectedHeader = encodeURIComponent(selectedHeader);
      //if the controlledHeader includes ( ), search without a facet option.
      if(selectedHeader.indexOf('(') > 0){
        selectedHeader = selectedHeader.replace('(',"").replace(')',"");
        resultUrl = "<?php echo base_url("?key=")?>"+ selectedHeader+"&facet=NULL";
      }else{
        resultUrl = "<?php echo base_url("?key=")?>"+ selectedHeader+"&facet="+selectedFacet;
      }
        window.open(resultUrl,"_self");
    });

    $('a.searchTerm').click(function() {
      var repositoryName =  $(this).text();
        var repositoryName = repositoryName.trim();
        var repositoryName = repositoryName.replace(/ /g,"%20");
        var repositoryName = encodeURIComponent(repositoryName);
        resultUrl = "<?php echo base_url("?key=")?>"+ repositoryName +"&facet=corpname_facet";
        window.open(resultUrl);
    });
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++)
    {
      acc[i].onclick = function()
      {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
          panel.style.display = "none";

        } else {
          panel.style.display = "block";
        }
      }
    }

 $('h4.infoAccordion').click(function(){
  $(this).find('span').toggleClass('glyphicon-menu-right').toggleClass('glyphicon-menu-down');
 });

 $('button#tocbutton').toggle(function(){
    $('#tocResponsive').html('<label>Series in this Collection: </label><?php echo '<ul id="tree">' . $GLOBALS['tree'] . '</ul>'; ?>');
 });
 function expand() {
     $('.stuff').slideDown(400);
     $('.collapse').slideDown(400);
 }

 function collapse() {
     $('.stuff').slideUp(400);
     $('.collapse').slideUp(400);
 }
</script>
</html>
