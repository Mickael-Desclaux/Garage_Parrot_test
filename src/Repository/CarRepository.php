<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function save(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findCarsByFilter(array $filter): array
    {
        $queryBuilder = $this->createQueryBuilder('car');


        if (!empty($filter["car_filter"]["price"]['price_min'])) {
            $queryBuilder
                ->andWhere('car.price >= :price_min')
                ->setParameter('price_min', $filter["car_filter"]["price"]['price_min']);
        }

        if (!empty($filter["car_filter"]["price"]['price_max'])) {
            $queryBuilder
                ->andWhere('car.price <= :price_max')
                ->setParameter('price_max', $filter["car_filter"]["price"]['price_max']);
        }

        if (!empty($filter["car_filter"]['brand'])) {
            $brand = preg_replace('/[^a-zA-Z0-9\s]/', '', $filter["car_filter"]['brand']);
            $brand = str_replace(' ', '-', $brand);
            $queryBuilder
                ->andWhere('LOWER(car.brand) LIKE LOWER(:brand)')
                ->setParameter('brand', '%' . $brand . '%');
        }


        if (!empty($filter["car_filter"]["year"]['year_min']) && is_numeric($filter["car_filter"]["year"]['year_min'])) {
            $queryBuilder
                ->andWhere('car.year >= :year_min')
                ->setParameter('year_min', $filter["car_filter"]["year"]['year_min']);
        }

        if (!empty($filter["car_filter"]["year"]['year_max']) && is_numeric($filter["car_filter"]["year"]['year_max'])) {
            $queryBuilder
                ->andWhere('car.year <= :year_max')
                ->setParameter('year_max', $filter["car_filter"]["year"]['year_max']);
        }

        if (!empty($filter["car_filter"]["mileage"]['mileage_min']) && is_numeric($filter["car_filter"]["mileage"]['mileage_min'])) {
            $queryBuilder
                ->andWhere('car.mileage >= :mileage_min')
                ->setParameter('mileage_min', $filter["car_filter"]["mileage"]['mileage_min']);
        }

        if (!empty($filter["car_filter"]["mileage"]['mileage_max']) && is_numeric($filter["car_filter"]["mileage"]['mileage_max'])) {
            $queryBuilder
                ->andWhere('car.mileage <= :mileage_max')
                ->setParameter('mileage_max', $filter["car_filter"]["mileage"]['mileage_max']);
        }

        if (!empty($filter["car_filter"]["horsepower"]['horsepower_min']) && is_numeric($filter["car_filter"]["horsepower"]['horsepower_min'])) {
            $queryBuilder
                ->andWhere('car.horsepower >= :horsepower_min')
                ->setParameter('horsepower_min', $filter["car_filter"]["horsepower"]['horsepower_min']);
        }

        if (!empty($filter["car_filter"]["horsepower"]['horsepower_max']) && is_numeric($filter["car_filter"]["horsepower"]['horsepower_max'])) {
            $queryBuilder
                ->andWhere('car.horsepower <= :horsepower_max')
                ->setParameter('horsepower_max', $filter["car_filter"]["horsepower"]['horsepower_max']);
        }

        if (!empty($filter["car_filter"]['energy'])) {
            $queryBuilder
                ->andWhere('car.energy = :energy')
                ->setParameter('energy', $filter["car_filter"]['energy']);
        }


        if (!empty($filter["car_filter"]['gearbox'])) {
            $queryBuilder
                ->andWhere('car.gearbox = :gearbox')
                ->setParameter('gearbox', $filter["car_filter"]['gearbox']);
        }

        if (!empty($filter["car_filter"]['doors'])) {
            $queryBuilder
                ->andWhere('car.doors = :doors')
                ->setParameter('doors', $filter["car_filter"]['doors']);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function totalCarCount()
    {
        return $this->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
