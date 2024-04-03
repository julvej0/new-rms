<?php

function getPublications($publicationurl)
{
  $response = @file_get_contents($publicationurl);
  $jsonData = json_decode($response, true)['table_publications'];

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

  return null;
}

function updatePublicationsByAuthor($publicationurl, $author)
{
  $response = @file_get_contents($publicationurl);
  if ($response === false) {
    echo "An error occurred while fetching user data.";
    return null;
  }

  $publicationData = json_decode($response, true)['table_publications'];
  foreach ($publicationData as $key => $publication) {
    if (strpos($publication['authors'], $author) !== false) {
      $authors = explode(',', $publication['authors']);
      $result = array_diff($authors, array($author));
      $authorToString = implode(',', $result);
      $jsonData = $publication;
      $jsonData['authors'] = $authorToString;
      $url = $publicationurl . '/' . $publication['publication_id'];
      $data = json_encode($jsonData);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
      ]);

      $response = curl_exec($ch);
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
      if ($httpCode != 200) {
        return null;
      }
    }
  }
  return 'Task Completed';
}