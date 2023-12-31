<?php
/*
LXDWARE LXD Dashboard - A web-based interface for managing LXD servers
Copyright (C) 2020-2021  LXDWARE.COM

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

//Start session if not already started
if (!isset($_SESSION)) {
  session_start();
}

//Require code from lxd-dashboard/backend/aaa/authorization.php
require_once('../aaa/authorization.php');

//Require code from lxd-dashboard/backend/config/db.php
require_once('../config/db.php');



function sendCurlRequest($request_action, $request_type, $request_url, $request_data = "{}"){
  $cert = "/var/lxdware/data/lxd/client.crt";
  $key = "/var/lxdware/data/lxd/client.key";

  //Set required variables
  $get_connection_timeout = (isset($_SESSION['get_connection_timeout'])) ? $_SESSION['get_connection_timeout'] : 3;
  $get_operation_timeout = (isset($_SESSION['get_operation_timeout'])) ? $_SESSION['get_operation_timeout'] : 5;
  $post_connection_timeout = (isset($_SESSION['post_connection_timeout'])) ? $_SESSION['post_connection_timeout'] : 3;
  $post_operation_timeout = (isset($_SESSION['post_operation_timeout'])) ? $_SESSION['post_operation_timeout'] : 5;
  $patch_connection_timeout = (isset($_SESSION['patch_connection_timeout'])) ? $_SESSION['patch_connection_timeout'] : 3;
  $patch_operation_timeout = (isset($_SESSION['patch_operation_timeout'])) ? $_SESSION['patch_operation_timeout'] : 5;
  $put_connection_timeout = (isset($_SESSION['put_connection_timeout'])) ? $_SESSION['put_connection_timeout'] : 3;
  $put_operation_timeout = (isset($_SESSION['put_operation_timeout'])) ? $_SESSION['put_operation_timeout'] : 5;
  $delete_connection_timeout = (isset($_SESSION['delete_connection_timeout'])) ? $_SESSION['delete_connection_timeout'] : 3;
  $delete_operation_timeout = (isset($_SESSION['delete_operation_timeout'])) ? $_SESSION['delete_operation_timeout'] : 5;

  if (validateAuthorization($request_action)) {
    switch ($request_type) {
      case "GET":
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSLCERT, $cert);
        curl_setopt($ch, CURLOPT_SSLKEY, $key);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $get_connection_timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $get_operation_timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $return_value = curl_exec($ch);

        if (curl_errno($ch)) {
          $return_value = '{"status": "Bad Request", "status_code": 400, "metadata": {"err": "Unable to execute GET action on remote host", "status_code": "400"}}';
        }
        
        curl_close($ch);

        return $return_value;
        break;

      case "POST":
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSLCERT, $cert);
        curl_setopt($ch, CURLOPT_SSLKEY, $key);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $post_connection_timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $post_operation_timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $return_value = curl_exec($ch);

        if (curl_errno($ch)) {
          $return_value = '{"status": "Bad Request", "status_code": 400, "metadata": {"err": "Unable to execute POST action on remote host", "status_code": "400"}}';
        }
        
        curl_close($ch);
        return $return_value;
        break;

      case "PUT":
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSLCERT, $cert);
        curl_setopt($ch, CURLOPT_SSLKEY, $key);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $put_connection_timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $put_operation_timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $return_value = curl_exec($ch);

        if (curl_errno($ch)) {
          $return_value = '{"status": "Bad Request", "status_code": 400, "metadata": {"err": "Unable to execute PUT action on remote host", "status_code": "400"}}';
        }
        
        curl_close($ch);
        return $return_value;
        break;

      case "PATCH":
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSLCERT, $cert);
        curl_setopt($ch, CURLOPT_SSLKEY, $key);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $patch_connection_timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $patch_operation_timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $return_value = curl_exec($ch);

        if (curl_errno($ch)) {
          $return_value = '{"status": "Bad Request", "status_code": 400, "metadata": {"err": "Unable to execute PATCH action on remote host", "status_code": "400"}}';
        }
        
        curl_close($ch);
        return $return_value;
        break;
        
      case "DELETE":
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSLCERT, $cert);
        curl_setopt($ch, CURLOPT_SSLKEY, $key);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $delete_connection_timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $delete_operation_timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $return_value = curl_exec($ch);

        if (curl_errno($ch)) {
          $return_value = '{"status": "Bad Request", "status_code": 400, "metadata": {"err": "Unable to execute DELETE action on remote host", "status_code": "400"}}';
        }
        
        curl_close($ch);
        return $return_value;
        break;
    }
  }
  else {
      $return_value = '{"status": "Forbidden", "status_code": 403, "error_code": 403, "error": "You are not authorized to execute this action", "metadata": {"err": "You are not authorized to execute this action", "status_code": "403"}}';
      return $return_value;
  }
    

}

?>