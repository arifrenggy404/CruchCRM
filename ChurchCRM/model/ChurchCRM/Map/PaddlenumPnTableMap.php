<?php

/**
 * MIT License. This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChurchCRM\model\ChurchCRM\Map;

use ChurchCRM\model\ChurchCRM\PaddlenumPn;
use ChurchCRM\model\ChurchCRM\PaddlenumPnQuery;
use Propel\Runtime\ActiveQuery\ColumnResolver\ColumnExpression\LocalColumnExpression;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use Propel\Runtime\Propel;


/**
 * This class defines the structure of the 'paddlenum_pn' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PaddlenumPnTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'ChurchCRM.model.ChurchCRM.Map.PaddlenumPnTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'paddlenum_pn';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'PaddlenumPn';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\ChurchCRM\\model\\ChurchCRM\\PaddlenumPn';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'ChurchCRM.model.ChurchCRM.PaddlenumPn';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the pn_ID field
     */
    public const COL_PN_ID = 'paddlenum_pn.pn_ID';

    /**
     * the column name for the pn_fr_ID field
     */
    public const COL_PN_FR_ID = 'paddlenum_pn.pn_fr_ID';

    /**
     * the column name for the pn_Num field
     */
    public const COL_PN_NUM = 'paddlenum_pn.pn_Num';

    /**
     * the column name for the pn_per_ID field
     */
    public const COL_PN_PER_ID = 'paddlenum_pn.pn_per_ID';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * @var class-string<\ChurchCRM\model\ChurchCRM\Base\Collection\PaddlenumPnCollection>
     */
    public const DEFAULT_OBJECT_COLLECTION = '\ChurchCRM\model\ChurchCRM\Base\Collection\PaddlenumPnCollection';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['PnId', 'PnFrId', 'PnNum', 'PnPerId', ],
        self::TYPE_CAMELNAME     => ['pnId', 'pnFrId', 'pnNum', 'pnPerId', ],
        self::TYPE_COLNAME       => [PaddlenumPnTableMap::COL_PN_ID, PaddlenumPnTableMap::COL_PN_FR_ID, PaddlenumPnTableMap::COL_PN_NUM, PaddlenumPnTableMap::COL_PN_PER_ID, ],
        self::TYPE_FIELDNAME     => ['pn_ID', 'pn_fr_ID', 'pn_Num', 'pn_per_ID', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['PnId' => 0, 'PnFrId' => 1, 'PnNum' => 2, 'PnPerId' => 3, ],
        self::TYPE_CAMELNAME     => ['pnId' => 0, 'pnFrId' => 1, 'pnNum' => 2, 'pnPerId' => 3, ],
        self::TYPE_COLNAME       => [PaddlenumPnTableMap::COL_PN_ID => 0, PaddlenumPnTableMap::COL_PN_FR_ID => 1, PaddlenumPnTableMap::COL_PN_NUM => 2, PaddlenumPnTableMap::COL_PN_PER_ID => 3, ],
        self::TYPE_FIELDNAME     => ['pn_ID' => 0, 'pn_fr_ID' => 1, 'pn_Num' => 2, 'pn_per_ID' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string, string>
     */
    protected $normalizedColumnNameMap = [
        'PnId' => 'PN_ID',
        'PaddlenumPn.PnId' => 'PN_ID',
        'pnId' => 'PN_ID',
        'paddlenumPn.pnId' => 'PN_ID',
        'PaddlenumPnTableMap::COL_PN_ID' => 'PN_ID',
        'COL_PN_ID' => 'PN_ID',
        'pn_ID' => 'PN_ID',
        'paddlenum_pn.pn_ID' => 'PN_ID',
        'PnFrId' => 'PN_FR_ID',
        'PaddlenumPn.PnFrId' => 'PN_FR_ID',
        'pnFrId' => 'PN_FR_ID',
        'paddlenumPn.pnFrId' => 'PN_FR_ID',
        'PaddlenumPnTableMap::COL_PN_FR_ID' => 'PN_FR_ID',
        'COL_PN_FR_ID' => 'PN_FR_ID',
        'pn_fr_ID' => 'PN_FR_ID',
        'paddlenum_pn.pn_fr_ID' => 'PN_FR_ID',
        'PnNum' => 'PN_NUM',
        'PaddlenumPn.PnNum' => 'PN_NUM',
        'pnNum' => 'PN_NUM',
        'paddlenumPn.pnNum' => 'PN_NUM',
        'PaddlenumPnTableMap::COL_PN_NUM' => 'PN_NUM',
        'COL_PN_NUM' => 'PN_NUM',
        'pn_Num' => 'PN_NUM',
        'paddlenum_pn.pn_Num' => 'PN_NUM',
        'PnPerId' => 'PN_PER_ID',
        'PaddlenumPn.PnPerId' => 'PN_PER_ID',
        'pnPerId' => 'PN_PER_ID',
        'paddlenumPn.pnPerId' => 'PN_PER_ID',
        'PaddlenumPnTableMap::COL_PN_PER_ID' => 'PN_PER_ID',
        'COL_PN_PER_ID' => 'PN_PER_ID',
        'pn_per_ID' => 'PN_PER_ID',
        'paddlenum_pn.pn_per_ID' => 'PN_PER_ID',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('paddlenum_pn');
        $this->setPhpName('PaddlenumPn');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ChurchCRM\\model\\ChurchCRM\\PaddlenumPn');
        $this->setPackage('ChurchCRM.model.ChurchCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('pn_ID', 'PnId', 'SMALLINT', true, 9, null);
        $this->addColumn('pn_fr_ID', 'PnFrId', 'SMALLINT', false, 9, null);
        $this->addColumn('pn_Num', 'PnNum', 'SMALLINT', false, 9, null);
        $this->addColumn('pn_per_ID', 'PnPerId', 'SMALLINT', true, 9, 0);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PnId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PnId', TableMap::TYPE_PHPNAME, $indexType)] === null || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PnId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PnId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string)$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PnId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PnId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.
     * For tables with a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        $pnIdIx = $indexType === TableMap::TYPE_NUM
            ? 0 + $offset
            : self::translateFieldName('PnId', TableMap::TYPE_PHPNAME, $indexType);

        return (int)$row[$pnIdIx];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     *
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? PaddlenumPnTableMap::CLASS_DEFAULT : PaddlenumPnTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
     *                           One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return array (PaddlenumPn object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PaddlenumPnTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (($obj = PaddlenumPnTableMap::getInstanceFromPool($key)) !== null) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PaddlenumPnTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PaddlenumPnTableMap::OM_CLASS;
            /** @var PaddlenumPn $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PaddlenumPnTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param \Propel\Runtime\DataFetcher\DataFetcherInterface $dataFetcher
     *
     * @return array<object>
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = PaddlenumPnTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (($obj = PaddlenumPnTableMap::getInstanceFromPool($key)) !== null) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new PaddlenumPn();
                $obj->hydrate($row);
                $results[] = $obj;
                PaddlenumPnTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param \Propel\Runtime\ActiveQuery\Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     *
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        $tableMap = static::getTableMap();
        $tableAlias = $alias ?: 'paddlenum_pn';
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['PN_ID']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['PN_FR_ID']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['PN_NUM']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['PN_PER_ID']));
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param \Propel\Runtime\ActiveQuery\Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     *
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if ($alias === null) {
            $criteria->removeSelectColumn(PaddlenumPnTableMap::COL_PN_ID);
            $criteria->removeSelectColumn(PaddlenumPnTableMap::COL_PN_FR_ID);
            $criteria->removeSelectColumn(PaddlenumPnTableMap::COL_PN_NUM);
            $criteria->removeSelectColumn(PaddlenumPnTableMap::COL_PN_PER_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.pn_ID');
            $criteria->removeSelectColumn($alias . '.pn_fr_ID');
            $criteria->removeSelectColumn($alias . '.pn_Num');
            $criteria->removeSelectColumn($alias . '.pn_per_ID');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     *
     * @return static
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(PaddlenumPnTableMap::DATABASE_NAME)->getTable(PaddlenumPnTableMap::TABLE_NAME);
    }

    /**
     * @deprecated Delete via model or PaddlenumPnQuery.
     *
     * Performs a DELETE on the database, given a PaddlenumPn or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or PaddlenumPn object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con the connection to use
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     *
     * @return int The number of affected rows (if supported by underlying database driver). This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     */
    public static function doDelete($values, ?ConnectionInterface $con = null): int
    {
        trigger_deprecation('Propel', '2.0', 'TableMap::doDelete() should not be used anymore, delete via model or PaddlenumPnQuery');

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PaddlenumPnTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            $criteria = $values;
        } elseif ($values instanceof PaddlenumPn) { // it's a model object
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PaddlenumPnTableMap::DATABASE_NAME);
            $criteria->addAnd(PaddlenumPnTableMap::COL_PN_ID, (array)$values, Criteria::IN);
        }

        $query = PaddlenumPnQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PaddlenumPnTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array)$values as $singleval) {
                PaddlenumPnTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the paddlenum_pn table.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con the connection to use
     *
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PaddlenumPnQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PaddlenumPn or Criteria object.
     *
     * @param \Propel\Runtime\ActiveQuery\Criteria|\ChurchCRM\model\ChurchCRM\PaddlenumPn $criteria
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     *
     * @return mixed The new primary key.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PaddlenumPnTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria;
            $criteria->turnFiltersToUpdateValues();
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PaddlenumPn object
        }

        if ($criteria->hasUpdateValue(PaddlenumPnTableMap::COL_PN_ID)) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (PaddlenumPnTableMap::COL_PN_ID)');
        }

        // Set the correct dbName
        $query = PaddlenumPnQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }
}
