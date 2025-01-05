<?php
ob_start();
error_reporting(E_ALL ^ E_DEPRECATED);
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$BD_TABLE = 'capstone';





function insert_update_delete($query)

 {



 global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;

$con=mysqli_connect($DB_HOST, $DB_USER,$DB_PASS);

mysqli_select_db($con,$BD_TABLE) or die( "Unable to select database");



   mysqli_query($con,$query)or die( "Unable to execute query");





mysqli_close($con);

  }







function select_info($query)

{

//echo $query;

global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;

mysql_connect($DB_HOST, $DB_USER,$DB_PASS);

mysql_select_db($BD_TABLE) or die( "Unable to select database");



//mysql_query($query);



if($res=mysql_query($query))

    {

		if(mysql_num_rows($res))

        {

		    $retvalue = array();



			while($r=mysql_fetch_array($res,MYSQL_BOTH))

            {

                $a_keys = array_keys($r);

                //in supplying the query string specify first the ID (PK) ex. select id, name etc..

				$retvalue[$r[0]] = array();



                //(

                //'str_license'=>$r['str_license']

			   	//,'str_license_description'=>html_entity_decode(stripslashes($r['str_license_description']),ENT_QUOTES)

			    //);



                 for($x = 0; $x<count($a_keys); $x++)

                    {

                     $retvalue[$r[0]][$a_keys[$x]]=html_entity_decode(stripslashes($r[$a_keys[$x]]),ENT_QUOTES);

                    }



			}

			return $retvalue;

		}

		else

        {

		//addDebug('InfoMgmt_getLicense','Zero Result');

		return null;

		}

	}

else

    {

	//addDebug('InfoMgmt_getLicense',sql);

	//addDebug('InfoMgmt_getLicense',mysql_error());

	return null;

	}



mysqli_close();

}







/*function select_info_multiple_key($query)

{

//echo $query;

global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;

mysql_connect($DB_HOST, $DB_USER,$DB_PASS);

mysql_select_db($BD_TABLE) or die( "Unable to select database");



//mysql_query($query);



if($res=mysql_query($query))

    {

		if(mysql_num_rows($res))

        {

		    $retvalue = array();



            $ctr = 1;

			while($r=mysql_fetch_array($res,MYSQL_BOTH))

            {

                $a_keys = array_keys($r);

                //in supplying the query string specify first the ID (PK) ex. select id, name etc..

                $row_name = $r[0].$ctr;

				$retvalue[$row_name] = array();



                //(

                //'str_license'=>$r['str_license']

			   	//,'str_license_description'=>html_entity_decode(stripslashes($r['str_license_description']),ENT_QUOTES)

			    //);



                 for($x = 0; $x<count($a_keys); $x++)

                    {

                     $retvalue[$row_name][$a_keys[$x]]=html_entity_decode(stripslashes($r[$a_keys[$x]]),ENT_QUOTES);

                    }

              $ctr = $ctr+1;

			}

			return $retvalue;

		}

		else

        {

		//addDebug('InfoMgmt_getLicense','Zero Result');

		return null;

		}

	}

else

    {

	//addDebug('InfoMgmt_getLicense',sql);

	//addDebug('InfoMgmt_getLicense',mysql_error());

	return null;

	}



mysql_close();

}

*/





function select_info_multiple_key($query)

{

//echo $query;

global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;

$con=mysqli_connect($DB_HOST, $DB_USER,$DB_PASS);

mysqli_select_db($con,$BD_TABLE) or die( "Unable to select database");



//mysql_query($query);



if($res=mysqli_query($con,$query))

    {

		if(mysqli_num_rows($res))

        {

		    $retvalue = array();



            $ctr = 0;

			while($r=mysqli_fetch_array($res,MYSQLI_BOTH))

            {

                $a_keys = array_keys($r);

                //in supplying the query string specify first the ID (PK) ex. select id, name etc..

                //$row_name = $r[0].$ctr;

				$retvalue[$ctr] = array();



                //(

                //'str_license'=>$r['str_license']

			   	//,'str_license_description'=>html_entity_decode(stripslashes($r['str_license_description']),ENT_QUOTES)

			    //);



                 for($x = 0; $x<count($a_keys); $x++)

                    {

                     $retvalue[$ctr][$a_keys[$x]]=html_entity_decode(stripslashes($r[$a_keys[$x]]),ENT_QUOTES);

                    }

              $ctr = $ctr+1;

			}

			return $retvalue;

		}

		else

        {

		//addDebug('InfoMgmt_getLicense','Zero Result');

		return null;

		}

	}

else

    {

	//addDebug('InfoMgmt_getLicense',sql);

	//addDebug('InfoMgmt_getLicense',mysql_error());

	return null;

	}



mysql_close($con);

}





function select_info_1D($query)

{

//echo $query;

global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;

mysql_connect($DB_HOST, $DB_USER,$DB_PASS);

mysql_select_db($BD_TABLE) or die( "Unable to select database");



//mysql_query($query);



if($res=mysql_query($query))

    {

		if(mysql_num_rows($res))

        {

		    $retvalue = array();



			while($r=mysql_fetch_array($res,MYSQL_BOTH))

            {

                $a_keys = array_keys($r);





                 for($x = 0; $x<count($a_keys); $x++)

                    {

                     $retvalue[]=html_entity_decode(stripslashes($r[$x]),ENT_QUOTES);

                    }



			}

			return $retvalue;

		}

		else

        {

		//addDebug('InfoMgmt_getLicense','Zero Result');

		return null;

		}

	}

else

    {

	//addDebug('InfoMgmt_getLicense',sql);

	//addDebug('InfoMgmt_getLicense',mysql_error());

	return null;

	}



mysql_close();

}







function select_info_1D_ASSOC($query)

{

//echo $query;

global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;

mysql_connect($DB_HOST, $DB_USER,$DB_PASS);

mysql_select_db($BD_TABLE) or die( "Unable to select database");



//mysql_query($query);



if($res=mysql_query($query))

    {

		if(mysql_num_rows($res))

        {

		    $retvalue = array();





			while($r=mysql_fetch_array($res,MYSQL_ASSOC))

            {

                $a_keys = array_keys($r);





                    foreach($a_keys as $keys)

                    {

                      $retvalue[$keys]=html_entity_decode(stripslashes($r[$keys]),ENT_QUOTES);

                    }







			}

			return $retvalue;

		}

		else

        {

		//addDebug('InfoMgmt_getLicense','Zero Result');

		return null;

		}

	}

else

    {

	//addDebug('InfoMgmt_getLicense',sql);

	//addDebug('InfoMgmt_getLicense',mysql_error());

	return null;

	}



mysql_close();

}

function cleanInput($input) {



  $search = array(

    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript

    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags

    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly

    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments

  );



    $output = preg_replace($search, '', $input);

    return $output;

  }



function sanitize($input) {

global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;

$con=mysqli_connect($DB_HOST, $DB_USER,$DB_PASS);

mysqli_select_db($con,$BD_TABLE) or die( "Unable to select database");



    if (is_array($input)) {

        foreach($input as $var=>$val) {

            $output[$var] = sanitize($val);

        }

    }

    else {

        if (get_magic_quotes_gpc()) {

            $input = stripslashes($input);

        }

        $input  = cleanInput($input);

        $output = mysqli_real_escape_string($con,$input);

    }

    return $output;

}



?>