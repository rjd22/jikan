<?php

namespace Jikan\Request\Search;

use Jikan\Exception\BadResponseException;
use Jikan\Helper\Constants;
use Jikan\Request\RequestInterface;

/**
 * Class UserSearchRequest
 *
 * @package Jikan\Request\Search
 */
class UserSearchRequest implements RequestInterface
{

    /**
     * @var string|null
     */
    private $query;

    /**
     * @var int
     */
    private $page;

    /**
     * Advanced Search
     */

    /**
     * @var string
     */
    private $location;

    /**
     * @var int
     */
    private $minAge = 0;

    /**
     * @var int
     */
    private $maxAge = 0;

    /**
     * @var int
     */
    private $gender = Constants::SEARCH_USER_GENDER_ANY;


    public function __construct(?string $query = null, int $page = 1)
    {
        $this->query = $query;
        $this->page = $page;

        $this->query = $this->query ?? '';

        $querySize = strlen($this->query);

        if ($querySize > 0 & $querySize < 3) {
            throw new BadResponseException('Search queries requires at least 3 characters');
        }
    }

    /**
     * Get the path to request
     *
     * @return string
     */
    public function getPath(): string
    {

        $query = http_build_query(
            [
                'q'      => $this->query,
                'show'   => ($this->page !== 1) ? 24 * ($this->page - 1) : null,
                'loc'   => $this->location,
                'agelow'  => $this->minAge,
                'agehigh' => $this->maxAge,
                'g'      => $this->gender,
            ]
        );

        return sprintf(
            'https://myanimelist.net/users.php?%s',
            $query
        );
    }

    /**
     * @param string|null $query
     * @return UserSearchRequest
     */
    public function setQuery(?string $query): UserSearchRequest
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param int $page
     * @return UserSearchRequest
     */
    public function setPage(int $page): UserSearchRequest
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param string $location
     * @return UserSearchRequest
     */
    public function setLocation(string $location): UserSearchRequest
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @param int $minAge
     * @return UserSearchRequest
     */
    public function setMinAge(int $minAge): UserSearchRequest
    {
        $this->minAge = $minAge;
        return $this;
    }

    /**
     * @param int $maxAge
     * @return UserSearchRequest
     */
    public function setMaxAge(int $maxAge): UserSearchRequest
    {
        $this->maxAge = $maxAge;
        return $this;
    }

    /**
     * @param int $gender
     * @return UserSearchRequest
     */
    public function setGender(int $gender): UserSearchRequest
    {
        $this->gender = $gender;
        return $this;
    }
}