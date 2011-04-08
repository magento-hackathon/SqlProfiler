<?php

class Firegento_SqlProfiler_Model_Observer {
	
	const XML_DEVELOPER_IP = 'dev/firegento/developer_ip';
	
	public function controllerFrontInitBefore($observer) {
		Mage::log('controller_front_init_before');
		
		if (Mage::getIsDeveloperMode() || $_SERVER['REMOTE_ADDR'] == Mage::getStoreConfig(self::XML_DEVELOPER_IP)) {
			
			/** @var $frontController Mage_Core_Controller_Varien_Front */
			$frontController = $observer->getEvent()->getFront();
			$channel = Zend_Wildfire_Channel_HttpHeaders::getInstance();
			$channel->setRequest( $frontController->getRequest() );
			$channel->setResponse( $frontController->getResponse() );

			$frontController->setWildfireChannel( $frontController );
		}
		
		return;
	
	}
	
	public function controllerFrontDispatchBeforeResponse($observer) 
	{
		if (Mage::getIsDeveloperMode() || $_SERVER['REMOTE_ADDR'] == Mage::getStoreConfig(self::XML_DEVELOPER_IP)) 
		{	
			Zend_Wildfire_Channel_HttpHeaders::getInstance()->flush();
		}
		return;	
	}

}