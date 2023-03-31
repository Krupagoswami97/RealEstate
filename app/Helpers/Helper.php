<?php

    // This is common function for API Response in json with error code and messages

    function APIResponse($success, $code, $error, $message, $data = [])
    {
        $responseArr = array();
        $responseArr['success'] = $success;
        $responseArr['code'] = $code;
        $responseArr['error'] = $error;
        $responseArr['message'] = stringFilter($message);
        if ($data) {
            $keys = array_keys($data);
            $count = [];
            if (count($keys) > 0) {
                // nested array count function
                foreach ($keys as $value) {
                    try {
                        $count[$value] = count($data[$value]);
                    } catch (\Throwable $th) {
                        $count[$value] = (!empty($value)) ? '1' : '0';
                    }
                }
            }

            $responseArr['count'] = $count;
            $responseArr['results'] = $data;
        } else {
            $responseArr['count'] = 0; // if data wasn't pass then it will be zero.
            $responseArr['results'] = null;
        }
        return $responseArr;
    }

    // It's used to remove tags & modify string

    function stringFilter($data)
    {
        # Filter String

        # Remove White Space
        $data = trim($data);

        # Remove HTML Tags
        $data = strip_tags($data);

        # Convert String to Lowercase
        $data = strtolower($data);

        # Replace Dot By Underscore
        $data = str_replace(".","._",$data);

        # Make First Letter Capital
        $data = ucwords($data);

        $data = mb_convert_case($data, MB_CASE_TITLE, "UTF-8");
        $data = str_replace("._",".",$data);
        return $data; //e.x. - Abc Efg
    }



?>
