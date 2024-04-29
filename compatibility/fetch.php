<?php
    function get($statement)
    {
        $collection = array();

        $count = $statement->num_rows;

        if ($count > 0)
        {
            while ($row = fetch($statement))
            {
                array_push($collection, $row);
            }

            $count = count($collection);

            if ($count > 0)
                return $collection;

            return null;
        }

        return null;
    }

    function fetch($statement)
    {
        if ($statement->num_rows > 0)
        {
            $metadata = $statement->result_metadata();

            $result = array();
            $parameters = array();

            while ($field = $metadata->fetch_field())
            {
                $parameters[] = &$result[$field->name];
            }

            call_user_func_array(
                array($statement, "bind_result"),
                $parameters
            );

            $row = $statement->fetch();

            if ($row)
                return $result;
        }

        return null;
    }
?>
