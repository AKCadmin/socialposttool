<?php
require_once 'awssdk.php';

function affiliategenie_settings()
{
}
function amazon_paapi5_api_handle($accessKey, $secretKey, $region, $marketplace, $endpoint, $affiliate_id, $search_index, $keyword)
{
	// Your Amazon Product API code goes here
	// Use the AWS SDK as needed
	// For example, interact with the Product API

	$api_result = call_amazon_paapi5_api($accessKey, $secretKey, $region, $marketplace, $endpoint, $affiliate_id, $search_index, $keyword);

	// Display or process the API result as needed
	// echo '<div class="loader">Please Wait While we are syncing the products</div>';
	return $api_result;
}

function call_amazon_paapi5_api($accessKey, $secretKey, $region, $marketplace, $endpoint, $affiliate_id, $search_index, $keyword)
{

	$serviceName = "ProductAdvertisingAPI";
	$region = $region;
	$accessKey = $accessKey;
	$secretKey = $secretKey;
	$payload = "{"
		. " \"Keywords\": \"$keyword\","
		. " \"Resources\": ["
		. "  \"CustomerReviews.Count\","
		. "  \"CustomerReviews.StarRating\","
		. "  \"Images.Primary.Large\","
		. "  \"ItemInfo.ByLineInfo\","
		. "  \"ItemInfo.ContentInfo\","
		. "  \"ItemInfo.ManufactureInfo\","
		. "  \"ItemInfo.ProductInfo\","
		. "  \"ItemInfo.Title\","
		. "  \"ItemInfo.Features\","
		. "  \"Offers.Listings.Price\","
		. "  \"RentalOffers.Listings.BasePrice\""
		. " ],"
		. " \"SearchIndex\": \"$search_index\","
		. " \"PartnerTag\": \"$affiliate_id\","
		. " \"PartnerType\": \"Associates\","
		. " \"Marketplace\": \"$marketplace\""
		. "}";

	$host = $endpoint;
	$uriPath = "/paapi5/searchitems";
	$awsv4 = new AwsV4($accessKey, $secretKey);
	$awsv4->setRegionName($region);
	$awsv4->setServiceName($serviceName);
	$awsv4->setPath($uriPath);
	$awsv4->setPayload($payload);
	$awsv4->setRequestMethod("POST");
	$awsv4->addHeader('content-encoding', 'amz-1.0');
	$awsv4->addHeader('content-type', 'application/json; charset=utf-8');
	$awsv4->addHeader('host', $host);
	$awsv4->addHeader('x-amz-target', 'com.amazon.paapi5.v1.ProductAdvertisingAPIv1.SearchItems');
	$headers = $awsv4->getHeaders();
	$headerString = "";
	foreach ($headers as $key => $value) {
		$headerString .= $key . ': ' . $value . "\r\n";
	}
	$params = array(
		'http' => array(
			'header' => $headerString,
			'method' => 'POST',
			'content' => $payload
		)
	);
	$stream = stream_context_create($params);

	$fp = @fopen('https://' . $host . $uriPath, 'rb', false, $stream);

	if (!$fp) {
		throw new Exception("Exception Occured");
	}
	$response = @stream_get_contents($fp);
	if ($response === false) {
		throw new Exception("Exception Occured");
	}
	$json_response = json_decode($response, true);

	// process_products($json_response, $marketplace);
	return $json_response;
}