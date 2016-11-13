<?php

namespace App;

use Excel;
use App\ObjectMapper;

class ExcelGenerator
{

	public function create( $name, $data, $headers, $map )
	{
		Excel::create( $name, function( $excel ) use ( $data, $headers, $map, $name ){
			    $excel->setTitle( $name );
			    $excel->sheet( $name, function( $sheet ) use ( $data, $headers, $map, $name ){
					    $this->populateHeaders( $sheet, $headers );
					    $this->populateData( $sheet, $data, $map );
			    });
		})->download( 'xls' );

	}

	private function populateData( $sheet, $data, $map )
	{
		$om 	= new ObjectMapper();
		$data 	= $om->transformArray( $data, $map );
		$sheet->fromArray($data, null, 'A2', false, false);
	}

	private function populateHeaders( $sheet, $headers )
	{
		if( !is_array($headers) )
			return false;
		$sheet->row( 1, $headers );
		$sheet->cells(
			'A1:'. chr( count( $headers ) + 64 ).'1' , 
			function( $cells ) 
			{
				$cells->setBackground( '#000000' );
				$cells->setFontColor('#ffffff');
				$cells->setAlignment('center');
				$cells->setFont(array(
				    'family'     => 'Arial',
				    'size'       => '12',
				    'bold'       =>  true
				));
			}
		);
		return true;
	}
}