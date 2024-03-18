<?php


function getPublications($publicationurl)
{
  $response = @file_get_contents($publicationurl);
  $jsonData = json_decode($response, true);

  if ($jsonData === false) {
    return null;
  }

  return $jsonData;

}

function getPublicationById($publicationurl, $publicationid)
{
  $response = @file_get_contents($publicationurl);
  $publicationData = json_decode($response, true)['table_publications'];

  if ($publicationData == false) {
    return null;
  }

  foreach ($publicationData as $key => $publication) {
    if ($publication["publication_id"] == $publicationid) {
      return $publication;
    }
  }

  return $publicationData;
}