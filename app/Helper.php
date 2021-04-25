<?php


/*Filter Select Options*/
if (!function_exists('filterOptions')) {
    function filterOptions($optArr)
    {
        $options = '';

        if (isset($optArr)) {
            foreach ($optArr as $opt) {

                switch ($opt) {
                    case 'e':
                        $options .= '<option value="=">Equals</option>';
                        break;
                    case 'ne':
                        $options .= '<option value="!=">Not Equal</option>';
                        break;
                    case 'gt':
                        $options .= '<option value=">">Greater than</option>';
                        break;
                    case 'gte':
                        $options .= '<option value=">=">Greater than or equal to</option>';
                        break;
                    case 'lt':
                        $options .= '<option value="<">Less than</option>';
                        break;
                    case 'lte':
                        $options .= '<option value="<=">Less than or equal to</option>';
                        break;
                    case 'lk':
                        $options .= '<option value="LIKE \'%...%\'">Contains</option>';
                        break;
                    case 'in':
                        $options .= '<option value="IN (...)">IN (...)</option>';
                        break;
                    case 'nin':
                        $options .= '<option value="NOT IN (...)">NOT IN (...)</option>';
                        break;
                    case 'bt':
                        $options .= '<option value="BETWEEN" id="between_range">BETWEEN</option>';
                        break;
                    case 'nbt':
                        $options .= '<option value="NOT BETWEEN">NOT BETWEEN</option>';
                        break;
                    case 'n':
                        $options .= '<option value="=\'\'" id="blank">IS BLANK</option>';
                        break;
                    case 'nn':
                        $options .= '<option value="!=\'\'">IS NOT BLANK</option>';
                        break;
                }
            }

            echo $options;
        }
    }
}


/*Query Filter*/
if (!function_exists('datatableFilterQuery')) {

    function datatableFilterQuery($query, $column, $operator, $input = null, $input_from = null, $input_to = null, $rawQuery = false)
    {
        if( isset($operator) && $operator != "" ){
            switch ($operator) {
                case ">"    :   return $query->where( $column, $operator, $input);
                case ">="   :   return $query->where( $column, $operator, $input);
                case "<"    :   return $query->where( $column, $operator, $input);
                case "<="   :   return $query->where( $column, $operator, $input);
                case "="    :
                    if ($rawQuery) {
                        return $query->whereRaw($column. ' = "' . $input . '"');
                    } else {
                        return $query->where( $column, $operator, $input);
                    }

                case "!="   :
                    if ($rawQuery) {
                        return $query->whereRaw($column. ' != "' . $input . '"');
                    } else {
                        return $query->where( $column, $operator, $input);
                    }

                case "IN (...)" :
                    $input = explode(',', $input);
                    if ($rawQuery) {
                        return $query->whereRaw($column. ' IN ("' .implode('","', $input). '")');
                    } else {
                        return $query->whereIn($column, $input);
                    }

                case "NOT IN (...)" :
                    $input = explode(',', $input);
                    if ($rawQuery) {
                        return $query->whereRaw($column. ' NOT IN ("' .implode('","', $input). '")');
                    } else {
                        return $query->whereNotIn($column, $input);
                    }

                case "=''"  :
                    if ($rawQuery) {
                        return $query->whereRaw($column. ' IS NULL ');
                    } else {
                        return $query->whereNull($column);
                    }

                case "!=''" :
                    if ($rawQuery) {
                        return $query->whereRaw($column. ' IS NOT NULL ');
                    } else {
                        return $query->whereNotNull($column);
                    }

                case "LIKE '%...%'" :
                    if ($rawQuery) {
                        return $query->whereRaw($column. ' like "%' . $input . '%"');
                    } else {
                        return $query->where($column, 'like', "%" . $input . "%");
                    }

                case "BETWEEN"  :
                $input = array($input_from, $input_to);
                return $query->whereBetween($column, $input);

                case "NOT BETWEEN"  :
                $input = array($input_from, $input_to);
                return $query->whereNotBetween($column, $input);
            }
        }
    }
}
