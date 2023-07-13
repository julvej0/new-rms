<?php
function submitDelete($id) {
    // Create a new cURL resource
    $curl = curl_init();
  
    // Configure the request
    curl_setopt($curl, CURLOPT_URL, "http://localhost:5000/table_publications/" . $id);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  
    // Execute the request
    $response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  
    // Close the cURL resource
    curl_close($curl);
  
    // Handle the response
    if ($status === 200) {
      // Remove the 'delete' parameter from the current URL
      $queryString = $_SERVER['QUERY_STRING'];
      parse_str($queryString, $queryArray);
      if (isset($queryArray['delete'])) {
        unset($queryArray['delete']);
      }
  
      // Append the 'delete=success' parameter to the modified URL
      $queryArray['delete'] = 'success';
      $newQueryString = http_build_query($queryArray);
      $newUrl = $_SERVER['PHP_SELF'] . '?' . $newQueryString;
      header('Location: ' . $newUrl);
      exit();
    } else {
      // Display an error message using SweetAlert library
      echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
          Swal.fire({
            icon: "error",
            title: "Delete was Unsuccessful",
            text: "Something went wrong! Please try again later!",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
          });
        </script>';
      echo $response;
    }
  }
?>  