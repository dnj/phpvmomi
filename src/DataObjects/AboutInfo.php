<?php

namespace dnj\phpvmomi\DataObjects;

/**
 * This data object type describes system information including the name, type, version, and build number.
 *
 * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/b50dcbbf-051d-4204-a3e7-e1b618c1e384/538cf2ec-b34f-4bae-a332-3820ef9e7773/vim.AboutInfo.html
 */
class AboutInfo extends DynamicData
{
    /**
     * Indicates whether or not the service instance represents a standalone host. If the service instance represents a standalone host, then the physical inventory for that service instance is fixed to that single host. VirtualCenter server provides additional features over single hosts. For example, VirtualCenter offers multi-host management.
     *
     * @var string Examples of values are: "VirtualCenter" - For a VirtualCenter instance. "HostAgent" - For host agent on an ESX Server or VMware Server hos
     */
    public $apiType;

    /**
     * The version of the API as a dot-separated string.
     *
     * @var string For example, "1.0.0".
     */
    public $apiVersion;

    /**
     * Build string for the server on which this call is made.
     *
     * @var string For example, x.y.z-num. This string does not apply to the API.
     */
    public $build;

    /**
     * @var string the complete product name, including the version information
     */
    public $fullName;

    /**
     * @var string a globally unique identifier associated with this service instance
     *
     * @since vSphere API 4.0
     */
    public $instanceUuid;

    /**
     * @var string The license product name
     *
     * @since vSphere API 4.0
     */
    public $licenseProductName;

    /**
     * @var string The license product version
     *
     * @since vSphere API 4.0
     */
    public $licenseProductVersion;

    /**
     * @var string version of the message catalog for the current session's locale
     */
    public $localeVersion;

    /**
     * @var string short form of the product name
     */
    public $name;

    /**
     * Operating system type and architecture.
     *
     * @var string Examples of values are:
     *             "win32-x86" - For x86-based Windows systems.
     *             "linux-x86" - For x86-based Linux systems.
     *             "vmnix-x86" - For the x86 ESX Server microkernel.
     */
    public $osType;

    /**
     *  The product ID is a unique identifier for a product line.
     *
     * @var string Examples of values are:
     *             "gsx" - For the VMware Server product.
     *             "esx" - For the ESX product.
     *             "embeddedEsx" - For the ESXi product.
     *             "vpx" - For the VirtualCenter product.
     */
    public $productLineId;

    /**
     * @var string name of the vendor of this product
     */
    public $vendor;

    /**
     * @var string Dot-separated version string. For example, "1.2".
     */
    public $version;
}
