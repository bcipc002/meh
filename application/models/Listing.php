<?php
class Listing{

	public $id = null;

	public $title = null;

	public $color = null;

	public $url = null;

	public $description = null;

	public $year = null;

	public $make = null;

	public $model = null;

	public $type = null;

	public $mileage = null;

	public function __construct( $data=array() ) {
	    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
	    if ( isset( $data['title'] ) ) $this->title = $data['title'];
	    if ( isset( $data['color'] ) ) $this->color = $data['color'];
	    if ( isset( $data['url'] ) ) $this->url = $data['url'];
	    if ( isset( $data['description'] ) ) $this->description = $data['description'];
	    if ( isset( $data['year'] ) ) $this->year = $data['year'];
	    if ( isset( $data['make'] ) ) $this->make = $data['make'];
	    if ( isset( $data['model'] ) ) $this->model = $data['model'];
	    if ( isset( $data['type'] ) ) $this->type = $data['type'];
	    if ( isset( $data['mileage'] ) ) $this->mileage = $data['mileage']; 
	}
    
  }
?>
