<?php


	abstract class InnerBuilder {

		
		protected function evalIncludeFile() {
			error_log("InnerBuilder build");
			$ic = $this->getIncludeFile();
			error_log("include: " . $ic);
			ob_start();
			include($ic);
			$returnVal = ob_get_contents();
			ob_end_clean();
			error_log("return: ".$returnVal);
			return $returnVal;		
		}
		
		function build() {
			return $this->evalIncludeFile();	
		}
    	
		function isPage() { return true; }
		
		abstract function getIncludeFile();
}
?>
