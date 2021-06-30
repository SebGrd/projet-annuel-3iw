<?php


namespace App\Core;


class TableBuilder
{
    public function __construct($class)
    {

    }

    public static function render($class, $excludeList = []) {
        $instance = new $class;
        $data = $instance->findAll([], [], true);
        $columns = array_diff($instance->getColumns(), $excludeList);
        $html = '<table class="datatable">';
        $html .= self::generateHeader($columns);
        $html .= self::generateRows($data, $columns);
        $html .= '</table>';
        echo $html;
    }

    private static function generateHeader($titles): string
    {
        $html = '<thead><tr>';
        foreach ($titles as $title) {
            $html .= "<th>{$title}</th>";
        }
        $html .= '</tr></thead>';
        return $html;
    }

    private static function generateRows($data, $titles): string
    {
        $html = '<tbody>';
        foreach ($data as $row) {
            $html .= "<tr>";
            foreach ($titles as $title) {
                $html .= '<td>'.htmlspecialchars($row->$title).'</td>';
            }
            $html .= "</tr>";
        }
        $html .= '</tr></tbody>';
        return $html;
    }
}