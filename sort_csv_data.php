/**
 * @param string CSV data string
 * @return string sorted CSV data string
 */
function sort_csv_columns ($csv_data) {
	$dataRows = preg_split('/\n/', $csv_data);
	$heading = explode(',', array_shift($dataRows));

	// Creating structured data
	$structuredData = [];
	foreach($dataRows as $row) {
		foreach(explode(',', $row) as $index => $data) {
			$structuredData[$heading[$index]][] = $data;
		}
	}

	// Sorting data
	ksort($structuredData);

	// Preparing CSV data
	$headingStr = implode(',', array_keys($structuredData));
	$dataStr = "{$headingStr}\n";
	while ( array_filter($structuredData) ) {
		$rowArr = [];
		foreach($structuredData as &$dataArr) {
			$rowArr[] = array_shift($dataArr);
		}
		$dataStr .= implode(',', $rowArr) . (count($dataArr) > 0 ? "\n" : '');
	}

	return $dataStr;
}
