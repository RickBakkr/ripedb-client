<?php
// Inet6num.php

namespace Dormilich\WebService\RIPE\DB\RPSL;

use Dormilich\WebService\RIPE\Object;
use Dormilich\WebService\RIPE\Attribute;
use Dormilich\WebService\RIPE\FixedAttribute;

class Inet6num extends Object
{
    const PRIMARYKEY = 'inet6num';

    /**
     * Create a RIPE INET6NUM object
     * 
     * @param string $netnum A block of or a single IPv6 address.
     * @return self
     */
    public function __construct($netnum)
    {
        $this->type = self::PRIMARYKEY;
        $this->init();
        $this->setAttribute(self::PRIMARYKEY, $netnum);
    }

    /**
     * Defines attributes for the INET6NUM RIPE object. 
     * 
     * @return void
     */
    protected function init()
    {
        $this->create('inet6num',    Attribute::REQUIRED, Attribute::SINGLE);
        $this->create('netname',     Attribute::REQUIRED, Attribute::SINGLE);
        $this->create('descr',       Attribute::REQUIRED, Attribute::MULTIPLE);
        $this->create('country',     Attribute::REQUIRED, Attribute::MULTIPLE);
        $this->create('geoloc',      Attribute::OPTIONAL, Attribute::SINGLE);
        $this->create('language',    Attribute::OPTIONAL, Attribute::MULTIPLE);
        $this->create('org',         Attribute::OPTIONAL, Attribute::SINGLE);
        $this->generated('sponsoring-org');
        $this->create('admin-c',     Attribute::REQUIRED, Attribute::MULTIPLE);
        $this->create('tech-c',      Attribute::REQUIRED, Attribute::MULTIPLE);

        $this->attributes['status'] = new FixedAttribute('status', Attribute::REQUIRED, [
            'ALLOCATED-BY-RIR', 'ALLOCATED-BY-LIR', 'AGGREGATED-BY-LIR', 
            'ASSIGNED',         'ASSIGNED PI',      'ASSIGNED ANYCAST', 
        ]);

        // this attribute is required if the status is set to 'AGGREGATED-BY-LIR'
        $this->create('assignment-size', Attribute::OPTIONAL, Attribute::SINGLE);
        $this->create('remarks',     Attribute::OPTIONAL, Attribute::MULTIPLE);
        $this->create('notify',      Attribute::OPTIONAL, Attribute::MULTIPLE);
        $this->create('mnt-by',      Attribute::REQUIRED, Attribute::MULTIPLE);
        $this->create('mnt-lower',   Attribute::OPTIONAL, Attribute::MULTIPLE);
        $this->create('mnt-routes',  Attribute::OPTIONAL, Attribute::MULTIPLE);
        $this->create('mnt-domains', Attribute::OPTIONAL, Attribute::MULTIPLE);
        $this->create('mnt-irt',     Attribute::OPTIONAL, Attribute::MULTIPLE);
        $this->create('changed',     Attribute::OPTIONAL, Attribute::MULTIPLE);
        $this->create('source',      Attribute::REQUIRED, Attribute::SINGLE);

        $this->generated('created');
        $this->generated('last-modified');
    }
}

/*
 * The allowed values for the 'status' attribute:
 * 
 * ‘ALLOCATED-BY-RIR’ 
 *      This is mostly used to identify blocks of addresses for which the RIPE 
 *      NCC is administratively responsible and allocations made to members by 
 *      the RIPE NCC.
 * ‘ALLOCATED-BY-LIR’ 
 *      This is equivalent to the inetnum status ‘SUB-ALLOCATED PA’. A member 
 *      can sub-allocate part of an allocation to another organisation. The 
 *      other organisation may take over some of the management of this 
 *      sub-allocation. However, the RIPE NCC member is still responsible for 
 *      the whole of their registered resources, even if some parts of it have 
 *      been sub-allocated to another organisation. Provisions have been built 
 *      in to the RIPE Database software to ensure that the member is always 
 *      technically in control of their allocated address space.
 *        With the inet6num object there is no equivalent to the inetnum 
 *      ‘LIR-PARTITIONED’ status values allowing partitioning of an allocation 
 *      by a member for internal business reasons.
 * ‘AGGREGATED-BY-LIR’ 
 *      With IPv6, it is not necessary to document each individual End User 
 *      assignment in the RIPE Database. If you have a group of End Users 
 *      who all require blocks of addresses of the same size, say a /56, 
 *      then you can create a large, single block with this status. 
 *      The “assignment-size:” attribute specifies the size of the End User 
 *      blocks. All assignments made from this block must have that size. 
 *      It is possible to have two levels of ‘AGGREGATED-BY-LIR’.
 * ‘ASSIGNED’ 
 *      These are assignments made by a member from their allocations to an 
 *      End User.
 * ‘ASSIGNED PI’ 
 *      These are assignments made by the RIPE NCC directly to an End User. 
 *      In most cases, there is a member acting as the sponsoring organisation 
 *      who handles the administrative processes on behalf of the End User. 
 *      The sponsoring organisation may also manage the resource and related 
 *      objects in the RIPE Database for the End User.
 * ‘ASSIGNED ANYCAST’ 
 *      This address space has been assigned for use in TLD anycast networks.
 */