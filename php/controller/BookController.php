<?php

require_once("model/BookDB.php");
require_once("ViewHelper.php");

class BookController {

    public static function index() {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_SPECIAL_CHARS);
        if (isset($id)) {
            ViewHelper::render("view/book-detail.php", ["book" => BookDB::get($id)]);
        } else {
            ViewHelper::render("view/book-list.php", ["books" => BookDB::getAll()]);
        }
    }

    public static function showAddForm($values = ["author" => "", "title" => "",
        "price" => "", "year" => ""]) {
        ViewHelper::render("view/book-add.php", $values);
    }
    
    public static function search() {
        $searchString = filter_input(INPUT_POST, "searchString", FILTER_SANITIZE_SPECIAL_CHARS);
        if (isset($searchString)) {
            ViewHelper::render("view/search-result.php", ["books" => BookDB::searchBooks($searchString)]);
        } else {
            ViewHelper::render("view/search.php");
        }
    }

    public static function add() {
        $author = filter_input(INPUT_POST, "author", FILTER_SANITIZE_SPECIAL_CHARS);
        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
        $year = filter_input(INPUT_POST, "year", FILTER_SANITIZE_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_SPECIAL_CHARS);
        $validData = isset($author) && !empty($author) &&
                isset($title) && !empty($title) &&
                isset($year) && !empty($year) &&
                isset($price) && !empty($price);
                
        if ($validData) {
            BookDB::insert($author, $title, $price, $year);
            ViewHelper::redirect(BASE_URL . "book");
        } else {
            self::showAddForm(filter_input_array(INPUT_POST));
        }
    }

    public static function showEditForm($book = []) {
        if (empty($book)) {
            $book = BookDB::get(filter_input(INPUT_GET, "id", FILTER_SANITIZE_SPECIAL_CHARS));
        }

        ViewHelper::render("view/book-edit.php", ["book" => $book]);
    }

    public static function edit() {
        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
        $author = filter_input(INPUT_POST, "author", FILTER_SANITIZE_SPECIAL_CHARS);
        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
        $year = filter_input(INPUT_POST, "year", FILTER_SANITIZE_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_SPECIAL_CHARS);
        $activeBook = filter_input(INPUT_POST, "activeBook", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $validData = isset($author) && !empty($author) &&
                isset($title) && !empty($title) &&
                isset($year) && !empty($year) &&
                isset($price) && !empty($price) &&
                isset($id) && !empty($id)&&
                isset($activeBook);
        
        echo $id;
        
        if ($validData) {
            BookDB::update($id, $author, $title, $price, $year, $activeBook);
            ViewHelper::redirect(BASE_URL . "book?id=" . $id);
        } else {
            self::showEditForm(filter_input_array(INPUT_POST));
        }
    }

    public static function delete() {
        $deleteConfirmation = filter_input(INPUT_POST, "delete_confirmation", FILTER_SANITIZE_SPECIAL_CHARS);
        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
        $validDelete = isset($deleteConfirmation) && isset($id) && !empty($id);

        if ($validDelete) {
            BookDB::delete($id);
            $url = BASE_URL . "book";
        } else {
            if (isset($id)) {
                $url = BASE_URL . "book/edit?id=" . $id;
            } else {
                $url = BASE_URL . "book";
            }
        }

        ViewHelper::redirect($url);
    }
}
