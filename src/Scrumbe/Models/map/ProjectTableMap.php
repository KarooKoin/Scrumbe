<?php

namespace Scrumbe\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'project' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator..map
 */
class ProjectTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.ProjectTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('project');
        $this->setPhpName('Project');
        $this->setClassname('Scrumbe\\Models\\Project');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('url_name', 'UrlName', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('cover_project', 'CoverProject', 'VARCHAR', false, 255, '/assets/img/back-home.jpg');
        $this->addColumn('start_date', 'StartDate', 'DATE', false, null, null);
        $this->addColumn('end_date', 'EndDate', 'DATE', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Sprint', 'Scrumbe\\Models\\Sprint', RelationMap::ONE_TO_MANY, array('id' => 'project_id', ), 'CASCADE', null, 'Sprints');
        $this->addRelation('UserStory', 'Scrumbe\\Models\\UserStory', RelationMap::ONE_TO_MANY, array('id' => 'project_id', ), 'CASCADE', null, 'UserStories');
        $this->addRelation('LinkProjectUser', 'Scrumbe\\Models\\LinkProjectUser', RelationMap::ONE_TO_MANY, array('id' => 'project_id', ), 'CASCADE', null, 'LinkProjectUsers');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
        );
    } // getBehaviors()

} // ProjectTableMap
