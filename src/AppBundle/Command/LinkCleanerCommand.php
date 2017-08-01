<?php

namespace AppBundle\Command;

use AppBundle\Services\LinkDeleter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class that start up delete old links process
 */
class LinkCleanerCommand extends Command
{
    /**
     * @var LinkDeleter
     */
    private $linkDeleter;

    protected function configure()
    {
        $this
            ->setName('app:link_cleaner')
            ->setDescription('Delete links with expired time');
    }

    public function __construct(LinkDeleter $linkDeleter)
    {
        $this->linkDeleter = $linkDeleter;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->linkDeleter->cleanOldLink();
    }
}
