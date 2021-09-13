<?php
namespace dnj\phpvmomi\DataObjects;

/**
 * An ArrayUpdateSpec data object type is a common superclass for supporting incremental updates to arrays.
 * The common code pattern is:
 * class MyTypeSpec extrends ArrayUpdateSpec {
 * 		MyTypeInfo info;
 * }
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.option.ArrayUpdateSpec.html
 */
class ArrayUpdateSpec extends DynamicData
{
	/** @var string $operation possible values: "add", "remove", "edit" */
	public $operation;

	/** @var mixed $removeKey */
	public $removeKey;

	/** @var bool $enterFullScreenOnPowerOn */
	public $enterFullScreenOnPowerOn;

	/** @var bool $closeOnPowerOffOrSuspend */
	public $closeOnPowerOffOrSuspend;
}
