<?php
namespace MarcinsHW2\wrappers;

use MarcinsHW2\external\Spyc;
use MarcinsHW2\config\Rules;
use MarcinsHW2\models\Rule;

/**
 * class wrapping the Spyc Yaml reader
 * connects to Spyc to read rules from a yaml file 
 *
 * @author Malgorzata Wierzchowska <vertice2@outlook.com>
 * @version 0.2
 */

class YamlWrapper
{
	/**
	 * @var Rule[] $rules array of Rule objects
	 */
	private $rules = array();
	
	/**
	 * Loads password rulesfrom a Yamlfile using Spyc Yaml reader
	 *
	 * @return Rule[] array of Rule objects
	 */
	public function getRules()
	{
		try {
			$filepath = realpath (dirname(__FILE__));
			$arrData = Spyc::YAMLLoad($filepath.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."Rules.yaml");
			foreach($arrData as $ruleData)
			{
				$rule=new Rule($ruleData['rule'], $ruleData['errorMessage']);
				array_push($this->rules, $rule);
			}
			return $this->rules;
		}
		catch (Exception $ex)
		{
			throw new LocalException($ex->getMessage(), $ex->getCode(), $ex);
		}
	}
}