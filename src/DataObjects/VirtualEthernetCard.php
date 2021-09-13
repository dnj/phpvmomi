<?php
namespace dnj\phpvmomi\DataObjects;

class VirtualEthernetCard extends VirtualDevice
{
	/**
	 * @var string $addressType MAC address type.
	 * Valid values for address type are:
	 * Manual
     * 	Statically assigned MAC address.
	 * Generated
     * 	Automatically generated MAC address.
	 * Assigned
     * 	MAC address assigned by VirtualCenter.
	 */
	public $addressType;

	/**
	 * @var string $externalId An ID assigned to the virtual network adapter by external management plane or controller.
	 * 							The value and format of this property is determined by external management plane or controller, and vSphere doesn't do any validation.
	 * 							It's also up to external management plane or controller to set, unset or maintain this property.
	 * 							Setting this property with an empty string value will unset the property. 
	 * @since vSphere API 6.0
	 */
	public $externalId;

	/**
	 * @var string $macAddress MAC address assigned to the virtual network adapter.
	 * 							Clients can set this property to any of the allowed address types.
	 * 							The server might override the specified value for "Generated" or "Assigned" if it does not fall in the right ranges or is determined to be a duplicate. 
	 */
	public $macAddress;
	
	/**
	 * @var VirtualEthernetCardResourceAllocation $resourceAllocation Resource requirements of the virtual network adapter
	 * @since vSphere API 6.0
	 */
	public $resourceAllocation;

	/**
	 * @var bool $uptCompatibilityEnabled Indicates whether UPT(Universal Pass-through) compatibility is enabled on this network adapter.
	 * 										UPT is only compatible for Vmxnet3 adapter. Clients can set this property enabled or disabled if ethernet virtual device is Vmxnet3. 
	 * @since vSphere API 6.0
	 */
	public $uptCompatibilityEnabled;

	/**
	 * @var bool $wakeOnLanEnabled Indicates whether wake-on-LAN is enabled on this virtual network adapter. Clients can set this property to selectively enable or disable wake-on-LAN.
	 */
    public $wakeOnLanEnabled;
}
