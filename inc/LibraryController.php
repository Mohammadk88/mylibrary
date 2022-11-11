<?php

require 'PgSql.php';
include ('inc/config.php');

class LibraryController extends PgSql
{

    public function store($dataXML){
        $data = [];
        foreach($dataXML['books']['book'] as $child)
        {
            $data['author'] = $child['author']['value'];
            $data['book'] = $child['name']['value'];
            if($data['author'] != null && $data['book'] != null){
                 $id = $this->ifNotFirstTime($data['author']);
                if(!$id){
                    $sql = "INSERT INTO authors(name) VALUES ('".$data['author']."') ";
                    $id = $this->insert($sql);
                }
                $sql = "INSERT INTO books(name,author_id) VALUES ('".$data['book']."',".$id.") ";
                $book = $this->insert($sql);
            }
        }

        header("Location: ".PATH);
        exit();
    }

    public function xmlToArray(SimpleXMLElement $xml): array
    {
        $parser = function (SimpleXMLElement $xml, array $collection = []) use (&$parser) {
            $nodes = $xml->children();
            $attributes = $xml->attributes();

            if (0 !== count($attributes)) {
                foreach ($attributes as $attrName => $attrValue) {
                    $collection['attributes'][$attrName] = strval($attrValue);
                }
            }

            if (0 === $nodes->count()) {
                $collection['value'] = strval($xml);
                return $collection;
            }

            foreach ($nodes as $nodeName => $nodeValue) {
                if (count($nodeValue->xpath('../' . $nodeName)) < 2) {
                    $collection[$nodeName] = $parser($nodeValue);
                    continue;
                }

                $collection[$nodeName][] = $parser($nodeValue);
            }

            return $collection;
        };

        return [
            $xml->getName() => $parser($xml)
        ];
    }
    public function ifNotFirstTime($author){
        $sql = "SELECT id FROM authors where name='".$author."'";
        $row = $this->getRow($sql);
        if($row->id){
            return $row->id;
        }
        return null;
    }

    public function index($search = null): ?array
    {
        if($search){
            $sql = "SELECT DISTINCT
                    b.name AS book,
                    a.name AS author
                    FROM books AS b JOIN authors AS a
                    ON b.author_id = a.id
                       where a.name like '%".$search."%'";
        }else{
            $sql = "SELECT DISTINCT
                    b.name AS book,
                    a.name AS author
                    FROM books AS b JOIN authors AS a
                    ON b.author_id = a.id; ";
        }
        return $this->getRows($sql);

    }
}