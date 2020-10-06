<?php

class Car{
  private $model;
  private $year;
  private $company;

  public function __construct($model, $year, $company){
    $this->model = $model;
    $this->year = $year;
    $this->company = $company;
  }

  public function getCarDetails(){
    $carDetails = "Model: " . $this->model . " Year: " . $this->year . " Company: " . $this->company;
    return $carDetails;
  }
}
?>
