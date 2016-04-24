<?php 

	class Steam {
		
		public function __construct($ApiKey) {
			$this->key = $ApiKey;
			$this->imageurl = 'http://steamcommunity-a.akamaihd.net/economy/image/';
		}

		public function Inventory($App, $SteamID) {	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);    
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);			
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36");
			curl_setopt($ch, CURLOPT_URL,"http://steamcommunity.com/profiles/$SteamID/inventory/json/$App/2?l=turkish");
			$a = curl_exec($ch);
			$b = json_decode($a);	 		 
			if($b->success == TRUE):
			return $b->rgDescriptions;
			else:
			return FALSE;
			endif;
		}
		
		public function MarketPrice($App, $Item) {
			//Returns median price of an item.. 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);	
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36");
			curl_setopt($ch, CURLOPT_URL,"http://steamcommunity.com/market/priceoverview/?currency=17&appid=$App&market_hash_name=$Item");
			$a = curl_exec($ch);
			$b = json_decode($a);		
			
			return $b->median_price;
		}
		
		public function ImageLink($Iconurl) {
			return ''.$this->imageurl.''.$Iconurl.'';
		}
		
		public function ItemDetails($App, $Item) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);	
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36");
			curl_setopt($ch, CURLOPT_URL,"http://api.steampowered.com/ISteamEconomy/GetAssetClassInfo/v0001/?language=tr&key=$this->key&appid=$App&class_count=2&classid0=$Item");
			$a = curl_exec($ch);
			$b = json_decode($a);		
			
			return $b->$Item;
		}
		
	}
