<?php

namespace App\Core;

class TableBuilder
{
    /**
     * @param $class // Model
     * @param array $excludeList Array of excluding titles
     */
    public static function render($class, array $excludeList = [])
    {
        // Initialize the model class
        $instance = new $class();
        // Select all data from database
        $data = $instance->findAll([], [], true);
        // Create a reflection Class to get protected and private properties
        $reflect = new \ReflectionClass($instance);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED );

        // Remove properties that we don't want to show in the datatable
        $rows = [];
        foreach ($props as $prop) {
            if (in_array($prop->getName() , $excludeList)) {
                continue;
            }
            array_push($rows, $prop);
        }

        $html = '<table class="datatable">';
        $html .= self::generateHeader($rows);
        $html .= self::generateRows($data, $rows, $instance->getModelName());
        $html .= '</table>';
        echo $html;
    }

    private static function generateHeader($titles): string
    {
        $html = '<thead><tr>';
        foreach ($titles as $title) {
            $html .= "<th>" . ucfirst($title->getName()) . "</th>";
        }
        $html .= '<th style="width:120px">Actions</th>';
        $html .= '</tr></thead>';
        return $html;
    }

    private static function generateRows($data, $titles, $modelName): string
    {
        $html = '<tbody>';
        if (!empty($data)) {
            foreach ($data as $row) {
                $html .= "<tr>";
                foreach ($titles as $title) {
                    if ($title->getName() === 'image') {
                        $url = $row->{'get' . ucfirst($title->getName())}() !== null ? Helpers::getImageUrl($row->{'get' . ucfirst($title->getName())}()) : '';
                        if ($url) {
                            $html .= '<td>' . '<img src="' . '../' . $url . '" width="100" height="100"></td>';
                        } else {
                            $html .= '<td></td>';
                        }
                    } else if($title->getName() === 'createdAt' || $title->getName() === 'updatedAt') {
                        $time = strtotime($row->{'get' . ucfirst($title->getName())}());
                        $date = date('d/m/Y H:i', $time);
                        $html .= '<td>' . $date . '</td>';
                    } else {
                        $html .= '<td>' . $row->{'get' . ucfirst($title->getName())}() . '</td>';
                    }
                }
                $html .= '<td style="width:120px">
                    <a href="/'. $modelName .'?id=' . $row->getId() . '" class="btn btn-dark btn-icon-small">
                        <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#FFFFFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/></svg>
                    </a>
                    <a href="/admin/'. $modelName .'?id=' . $row->getId() . '" class="btn btn-primary btn-icon-small">
                        <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#FFFFFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
                    </a>
                    <a href="/admin/'. $modelName .'?id=' . $row->getId() . '&action=delete" class="btn btn-danger btn-icon-small">
                        <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#FFFFFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg> 
                    </a>
                </td>';
                $html .= "</tr>";
            }
        }
        $html .= '</tr></tbody>';
        return $html;
    }
}