<?php

class Sub_division_operation {
    private $conn;
    private $table = "sub_divisions";
    private $slider_tbl = "sliders";

    public $id;
    public $division_name;
    public $icon_img;
    public $slider_sub_text;
    public $slider_text;
    public $slider_image;
    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
    public function create() {

        try {

            $this->conn->beginTransaction();

            // Insert Sub Division
            $sqlSubDivision = "INSERT INTO ".$this->table."
            (division_name, date_created, date_modified, icon_img)
            VALUES (:division_name, :date_created, :date_modified, :icon_img)";

            $stmtSubDivision = $this->conn->prepare($sqlSubDivision);

            $stmtSubDivision->execute([
                ":division_name" => $this->division_name,
                ":date_created" => date("Y-m-d H:i:s"),
                ":date_modified" => date("Y-m-d H:i:s"),
                ":icon_img" => $this->icon_img
            ]);

            $newId = $this->conn->lastInsertId();

            // Insert Slider
            $sqlSliders = "INSERT INTO ".$this->slider_tbl."
            (slider_sub_text, slider_text, slider_image, sub_division_id)
            VALUES (:slider_sub_text, :slider_text, :slider_image, :sub_division_id)";

            $stmtSlider = $this->conn->prepare($sqlSliders);

            $stmtSlider->execute([
                ":slider_sub_text" => $this->slider_sub_text,
                ":slider_text" => $this->slider_text,
                ":slider_image" => $this->slider_image,
                ":sub_division_id" => $newId
            ]);

            $this->conn->commit();

            return true;

        } catch (PDOException $e) {

            $this->conn->rollback();

            echo $e->getMessage();

            return false;
        }
    }

    // READ
    public function read() {
        $query = "SELECT sub_div.*,slider.id as slider_id,slider.slider_sub_text,slider.slider_text,slider.slider_image
        FROM " . $this->table . " as sub_div
        INNER JOIN ".$this->slider_tbl." as slider ON slider.sub_division_id=sub_div.id
        WHERE sub_div.deleted=0
        GROUP BY sub_div.id
        ORDER BY sub_div.id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stmt;
    }

    // UPDATE
    public function update() {

        try {

            $this->conn->beginTransaction();

            // UPDATE SUB DIVISION
            $query1 = "UPDATE " . $this->table . "
                SET
                    division_name = :division_name,
                    icon_img = :icon_img
                WHERE id = :id";

            $stmt1 = $this->conn->prepare($query1);

            $stmt1->execute([
                ":division_name" => $this->division_name,
                ":icon_img" => $this->icon_img,
                ":id" => $this->id
            ]);

            // UPDATE SLIDER
            $query2 = "UPDATE " . $this->slider_tbl . "
                SET
                    slider_sub_text = :slider_sub_text,
                    slider_text = :slider_text,
                    slider_image = :slider_image
                WHERE sub_division_id = :sub_division_id";

            $stmt2 = $this->conn->prepare($query2);

            $stmt2->execute([
                ":slider_sub_text" => $this->slider_sub_text,
                ":slider_text" => $this->slider_text,
                ":slider_image" => $this->slider_image,
                // ":date_modified" => date("Y-m-d H:i:s"),
                ":sub_division_id" => $this->id
            ]);

            $this->conn->commit();

            return true;

        } catch (PDOException $e) {

            $this->conn->rollback();

            echo $e->getMessage();

            return false;
        }
    }

    public function getSingle() {

        $sql = "SELECT ".$this->table.".*,slider_tbl.slider_sub_text,slider_tbl.slider_text,slider_tbl.slider_image
        FROM ".$this->table."
        LEFT JOIN ".$this->slider_tbl." as slider_tbl
        ON ".$this->table.".id = slider_tbl.sub_division_id
        WHERE ".$this->table.".id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ":id" => $this->id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // DELETE
    public function delete() {
        $query = "UPDATE " . $this->table . " SET deleted=1 WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}
?>