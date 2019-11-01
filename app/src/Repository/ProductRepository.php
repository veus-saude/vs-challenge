<?php

namespace App\Repository;

use App\Entity\Product;
use ArrayObject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements RepositoryInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function criteriaPagination($queryString, $filter, $order, $page, $size) : array
    {
        
        $criteria = new Criteria();
        $likeItens = $filterItens = array();
        
        if(!empty($queryString) && strpos($queryString, ',')){
            $likeItens = explode(',', $queryString);
        }else if(!empty($queryString)){
            $likeItens[] = $queryString;
        }        

        if(!empty($filter) && strpos($filter, ',')){
            $filterItens = explode(',', $filter);
        }else if(!empty($filter)){
            $filterItens[] = $filter;
        }
            
        if(!empty($order)){
            $criteria->orderBy($order);
        }

        if(!empty($page))   
            $criteria->setFirstResult($page);
        if(!empty($size))    
            $criteria->setMaxResults($size);

        foreach ($likeItens as $item) {
            $criteria->orWhere(Criteria::expr()->contains('name', '%'.$item.'%'));
        }

        foreach ($filterItens as $item) {
            [$column, $value] = explode(':', $item);
            $criteria->andWhere(Criteria::expr()->eq($column, $value));
        }
       
        $result = $this->matching($criteria);

        
        return $result->getValues();
    }
}
