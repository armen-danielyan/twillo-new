<?php
	require 'vendor/autoload.php';

	use Google\Spreadsheet\DefaultServiceRequest;
	use Google\Spreadsheet\ServiceRequestFactory;

	class Spreadsheet
	{
		const spreadsheet_name = 'MySpreadsheet';
		const access_token     = "ya29.qAJhUAuZMmpSYXWKv2PPiidv-prkMLvbM8o9Hpbh8-mqyJgymmwEqnDRC7mrmbRASg";

		private $spreadsheetService,
				$spreadsheetFeed;
		public function __construct()
		{
			try{
				$serviceRequest = new DefaultServiceRequest(self::access_token);
				ServiceRequestFactory::setInstance($serviceRequest);
				
				$spreadsheetService = new Google\Spreadsheet\SpreadsheetService();
				$spreadsheetFeed = $spreadsheetService->getSpreadsheets();
				$spreadsheet = $spreadsheetFeed->getByTitle(self::spreadsheet_name);


				$worksheetFeed = $spreadsheet->getWorksheets();
				$worksheet = $worksheetFeed->getByTitle('Sheet1');
				
				
				$cellFeed = $worksheet->getCellFeed();

				$cellFeed->editCell(1,1, "AAAA");
				$cellFeed->editCell(1,2, "BBBB");
				$cellFeed->editCell(1,3, "CCCC");
				
			}catch(\Google\Spreadsheet\Exception $e){
				echo $e->getMessage();
			}
		}

		public static function out( $data, $type = false )
		{
			echo "<pre>";
			if(!$type)
			{
				print_r($data);
			}
			else
			{
				var_dump($data);
			}
			//exit;
			echo "</pre>";
		}
	}

	$sp = new Spreadsheet();
	
?>