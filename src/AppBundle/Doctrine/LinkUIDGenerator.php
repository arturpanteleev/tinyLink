<?php

namespace AppBundle\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\ORM\Mapping\Entity;

class LinkUIDGenerator extends AbstractIdGenerator
{
    /**
     * Максимальное кол-во попыток сгенерировать UID
     */
    const MAX_ATTEMPTS = 100;

    /**
     * Длина ссылки после сокращения
     */
    const TINY_LINK_LENGTH = 6;

    /**
     * Допустимые символы создания ссылки
     */
    const TINY_LINK_ALPHABET = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Метод генерации первичного ключа для поля tiny сущности Link
     * @param EntityManager $em
     * @param Entity        $entity
     *
     * @throws \Exception
     * @return string
     */
    public function generate(EntityManager $em, $entity): string
    {
        $entity_name = $em->getClassMetadata(get_class($entity))->getName();

        $attempt = 0;
        while (true) {
            $id = $this->getUID();
            $item = $em->find($entity_name, $id);

            if (!$item) {
                return $id;
            }

            $attempt++;
            if ($attempt > self::MAX_ATTEMPTS) {
                throw new \Exception('RandomIdGenerator worked hardly, but failed to generate unique ID :(');
            }
        }
    }

    /**
     * Возвращает случайную последовательность символов длинной $length
     *
     * @param int $length - длинна выходной строки
     *
     * @return string - выходная строка
     */
    private function getUID(int $length = self::TINY_LINK_LENGTH): string
    {
        $characters = self::TINY_LINK_ALPHABET;
        $charactersLength = mb_strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
