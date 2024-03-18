<?php 


function getPublications($publicationurl){

  $response = @file_get_contents($publicationurl);

  $jsonData = json_decode($response, true);

  if($jsonData === false){
    return null;
  }
  
  return $jsonData;
  
}