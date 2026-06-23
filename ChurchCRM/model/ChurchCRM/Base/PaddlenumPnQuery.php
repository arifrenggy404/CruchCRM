<?php

/**
 * MIT License. This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChurchCRM\model\ChurchCRM\Base;

use ChurchCRM\model\ChurchCRM\Map\PaddlenumPnTableMap;
use ChurchCRM\model\ChurchCRM\PaddlenumPn as ChildPaddlenumPn;
use ChurchCRM\model\ChurchCRM\PaddlenumPnQuery as ChildPaddlenumPnQuery;
use Exception;
use PDO;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\TypedModelCriteria;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Propel;

/**
 * Base class that represents a query for the `paddlenum_pn` table.
 *
 * @method static orderByPnId($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the pn_ID column
 * @method static orderByPnFrId($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the pn_fr_ID column
 * @method static orderByPnNum($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the pn_Num column
 * @method static orderByPnPerId($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the pn_per_ID column
 *
 * @method static groupByPnId() Group by the pn_ID column
 * @method static groupByPnFrId() Group by the pn_fr_ID column
 * @method static groupByPnNum() Group by the pn_Num column
 * @method static groupByPnPerId() Group by the pn_per_ID column
 *
 * @method static leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method static rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method static innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method static leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method static rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method static innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method \ChurchCRM\model\ChurchCRM\PaddlenumPn|null findOne(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return the first \ChurchCRM\model\ChurchCRM\PaddlenumPn matching the query
 * @method \ChurchCRM\model\ChurchCRM\PaddlenumPn findOneOrCreate(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return the first \ChurchCRM\model\ChurchCRM\PaddlenumPn matching the query, or a new \ChurchCRM\model\ChurchCRM\PaddlenumPn object populated from the query conditions when no match is found
 *
 * @method \ChurchCRM\model\ChurchCRM\PaddlenumPn|null findOneByPnId(int $pn_ID) Return the first \ChurchCRM\model\ChurchCRM\PaddlenumPn filtered by the pn_ID column
 * @method \ChurchCRM\model\ChurchCRM\PaddlenumPn|null findOneByPnFrId(int $pn_fr_ID) Return the first \ChurchCRM\model\ChurchCRM\PaddlenumPn filtered by the pn_fr_ID column
 * @method \ChurchCRM\model\ChurchCRM\PaddlenumPn|null findOneByPnNum(int $pn_Num) Return the first \ChurchCRM\model\ChurchCRM\PaddlenumPn filtered by the pn_Num column
 * @method \ChurchCRM\model\ChurchCRM\PaddlenumPn|null findOneByPnPerId(int $pn_per_ID) Return the first \ChurchCRM\model\ChurchCRM\PaddlenumPn filtered by the pn_per_ID column
 *
 * @method \ChurchCRM\model\ChurchCRM\PaddlenumPn requirePk($key, \Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return the \ChurchCRM\model\ChurchCRM\PaddlenumPn by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\PaddlenumPn requireOne(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return the first \ChurchCRM\model\ChurchCRM\PaddlenumPn matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method \ChurchCRM\model\ChurchCRM\PaddlenumPn requireOneByPnId(int $pn_ID) Return the first \ChurchCRM\model\ChurchCRM\PaddlenumPn filtered by the pn_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\PaddlenumPn requireOneByPnFrId(int $pn_fr_ID) Return the first \ChurchCRM\model\ChurchCRM\PaddlenumPn filtered by the pn_fr_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\PaddlenumPn requireOneByPnNum(int $pn_Num) Return the first \ChurchCRM\model\ChurchCRM\PaddlenumPn filtered by the pn_Num column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\PaddlenumPn requireOneByPnPerId(int $pn_per_ID) Return the first \ChurchCRM\model\ChurchCRM\PaddlenumPn filtered by the pn_per_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method \ChurchCRM\model\ChurchCRM\Base\Collection\PaddlenumPnCollection|array<\ChurchCRM\model\ChurchCRM\PaddlenumPn>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\PaddlenumPn> find(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return \ChurchCRM\model\ChurchCRM\PaddlenumPn objects based on current ModelCriteria
 * @method \ChurchCRM\model\ChurchCRM\Base\Collection\PaddlenumPnCollection findObjects(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Get \ChurchCRM\model\ChurchCRM\PaddlenumPn objects in ObjectCollection
 *
 * @method array<\ChurchCRM\model\ChurchCRM\PaddlenumPn>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\PaddlenumPn> findByPnId(int|array<int> $pn_ID) Return \ChurchCRM\model\ChurchCRM\PaddlenumPn objects filtered by the pn_ID column
 * @method array<\ChurchCRM\model\ChurchCRM\PaddlenumPn>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\PaddlenumPn> findByPnFrId(int|array<int> $pn_fr_ID) Return \ChurchCRM\model\ChurchCRM\PaddlenumPn objects filtered by the pn_fr_ID column
 * @method array<\ChurchCRM\model\ChurchCRM\PaddlenumPn>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\PaddlenumPn> findByPnNum(int|array<int> $pn_Num) Return \ChurchCRM\model\ChurchCRM\PaddlenumPn objects filtered by the pn_Num column
 * @method array<\ChurchCRM\model\ChurchCRM\PaddlenumPn>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\PaddlenumPn> findByPnPerId(int|array<int> $pn_per_ID) Return \ChurchCRM\model\ChurchCRM\PaddlenumPn objects filtered by the pn_per_ID column
 *
 * @method array<\ChurchCRM\model\ChurchCRM\PaddlenumPn>|\Propel\Runtime\Util\PropelModelPager<mixed> paginate($page = 1, $maxPerPage = 10, \Propel\Runtime\Connection\ConnectionInterface|null $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 * @template ParentQuery of \Propel\Runtime\ActiveQuery\ModelCriteria|null = null
 * @extends \Propel\Runtime\ActiveQuery\TypedModelCriteria<ParentQuery>
 */
abstract class PaddlenumPnQuery extends TypedModelCriteria
{
    /**
     * @var string
     */
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of PaddlenumPnQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string|null $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct(
        string $dbName = 'default',
        string $modelName = '\\ChurchCRM\\model\\ChurchCRM\\PaddlenumPn',
        ?string $modelAlias = null
    ) {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPaddlenumPnQuery object. XS
     *
     * @param string|null $modelAlias The alias of a model in the query
     * @param \Propel\Runtime\ActiveQuery\Criteria|null $criteria Optional Criteria to build the query from
     *
     * @return \ChurchCRM\model\ChurchCRM\PaddlenumPnQuery<null>
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPaddlenumPnQuery) {
            return $criteria;
        }
        $query = new ChildPaddlenumPnQuery();
        if ($modelAlias !== null) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(12, $con);
     * </code>
     *
     * @param int $key Primary key to use for the query
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return \ChurchCRM\model\ChurchCRM\Base\PaddlenumPn|mixed|array the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PaddlenumPnTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (!$this->isEmpty()) {
            return $this->findPkComplex($key, $con);
        }

        $poolKey = (string)$key;
        $obj = PaddlenumPnTableMap::getInstanceFromPool($poolKey);
        if ($obj !== null) {
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param \Propel\Runtime\Connection\ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \ChurchCRM\model\ChurchCRM\PaddlenumPn|null A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con): ?ChildPaddlenumPn
    {
        $sql = 'SELECT pn_ID, pn_fr_ID, pn_Num, pn_per_ID FROM paddlenum_pn WHERE pn_ID = :p0';
        $stmt = $con->prepare($sql);
        if (is_bool($stmt)) {
            throw new PropelException('Failed to initialize statement');
        }
        $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);

            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;

        $row = $stmt->fetch(PDO::FETCH_NUM);
        if ($row) {
            $obj = new ChildPaddlenumPn();
            $obj->hydrate($row);
            $poolKey = (string)$key;
            PaddlenumPnTableMap::addInstanceToPool($obj, $poolKey);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param \Propel\Runtime\Connection\ConnectionInterface $con A connection object
     *
     * @return \ChurchCRM\model\ChurchCRM\Base\PaddlenumPn|mixed|array|null the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     *
     * @param array $keys Primary keys to use for the query
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return \Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\Base\PaddlenumPn>|mixed|array the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (!$con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this
     */
    public function filterByPrimaryKey($key)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('pn_ID');
        $this->addUsingOperator($resolvedColumn, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array $keys The list of primary key values to use for the query
     *
     * @return static
     */
    public function filterByPrimaryKeys(array $keys)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('pn_ID');
        $this->addUsingOperator($resolvedColumn, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the pn_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByPnId(1234); // WHERE pn_ID = 1234
     * $query->filterByPnId(array(12, 34)); // WHERE pn_ID IN (12, 34)
     * $query->filterByPnId(array('min' => 12)); // WHERE pn_ID > 12
     * </code>
     *
     * @param mixed $pnId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByPnId($pnId = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('pn_ID');
        if (is_array($pnId)) {
            $useMinMax = false;
            if (isset($pnId['min'])) {
                $this->addUsingOperator($resolvedColumn, $pnId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pnId['max'])) {
                $this->addUsingOperator($resolvedColumn, $pnId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if ($comparison === null) {
                $comparison = Criteria::IN;
            }
        }
        $this->addUsingOperator($resolvedColumn, $pnId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pn_fr_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByPnFrId(1234); // WHERE pn_fr_ID = 1234
     * $query->filterByPnFrId(array(12, 34)); // WHERE pn_fr_ID IN (12, 34)
     * $query->filterByPnFrId(array('min' => 12)); // WHERE pn_fr_ID > 12
     * </code>
     *
     * @param mixed $pnFrId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByPnFrId($pnFrId = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('pn_fr_ID');
        if (is_array($pnFrId)) {
            $useMinMax = false;
            if (isset($pnFrId['min'])) {
                $this->addUsingOperator($resolvedColumn, $pnFrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pnFrId['max'])) {
                $this->addUsingOperator($resolvedColumn, $pnFrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if ($comparison === null) {
                $comparison = Criteria::IN;
            }
        }
        $this->addUsingOperator($resolvedColumn, $pnFrId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pn_Num column
     *
     * Example usage:
     * <code>
     * $query->filterByPnNum(1234); // WHERE pn_Num = 1234
     * $query->filterByPnNum(array(12, 34)); // WHERE pn_Num IN (12, 34)
     * $query->filterByPnNum(array('min' => 12)); // WHERE pn_Num > 12
     * </code>
     *
     * @param mixed $pnNum The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByPnNum($pnNum = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('pn_Num');
        if (is_array($pnNum)) {
            $useMinMax = false;
            if (isset($pnNum['min'])) {
                $this->addUsingOperator($resolvedColumn, $pnNum['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pnNum['max'])) {
                $this->addUsingOperator($resolvedColumn, $pnNum['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if ($comparison === null) {
                $comparison = Criteria::IN;
            }
        }
        $this->addUsingOperator($resolvedColumn, $pnNum, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pn_per_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByPnPerId(1234); // WHERE pn_per_ID = 1234
     * $query->filterByPnPerId(array(12, 34)); // WHERE pn_per_ID IN (12, 34)
     * $query->filterByPnPerId(array('min' => 12)); // WHERE pn_per_ID > 12
     * </code>
     *
     * @param mixed $pnPerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByPnPerId($pnPerId = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('pn_per_ID');
        if (is_array($pnPerId)) {
            $useMinMax = false;
            if (isset($pnPerId['min'])) {
                $this->addUsingOperator($resolvedColumn, $pnPerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pnPerId['max'])) {
                $this->addUsingOperator($resolvedColumn, $pnPerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if ($comparison === null) {
                $comparison = Criteria::IN;
            }
        }
        $this->addUsingOperator($resolvedColumn, $pnPerId, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param \ChurchCRM\model\ChurchCRM\PaddlenumPn|null $paddlenumPn Object to remove from the list of results
     *
     * @return $this
     */
    public function prune(?ChildPaddlenumPn $paddlenumPn = null)
    {
        if ($paddlenumPn) {
            $resolvedColumn = $this->resolveLocalColumnByName('pn_ID');
            $this->addUsingOperator($resolvedColumn, $paddlenumPn->getPnId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the paddlenum_pn table.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con the connection to use
     *
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (!$con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PaddlenumPnTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0;
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PaddlenumPnTableMap::clearInstancePool();
            PaddlenumPnTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con the connection to use
     *
     * @return int The number of affected rows (if supported by underlying database driver). This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (!$con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PaddlenumPnTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PaddlenumPnTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PaddlenumPnTableMap::removeInstanceFromPool($criteria);
            $affectedRows += ModelCriteria::delete($con);
            PaddlenumPnTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }
}
