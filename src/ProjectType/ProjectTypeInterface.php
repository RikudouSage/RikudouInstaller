<?php

namespace Rikudou\Installer\ProjectType;

interface ProjectTypeInterface
{
    /**
     * Returns the project friendly name for console output
     *
     * @return string
     */
    public function getFriendlyName(): string;

    /**
     * Returns the machine name for manually setting project type in composer.json
     *
     * @return string
     */
    public function getMachineName(): string;

    /**
     * Returns list of directories/files the project should contain. If any item is found, this class
     * is assumed as a valid type
     *
     * @return string[]
     */
    public function getMatchableFiles(): array;

    /**
     * Returns supported types of operations for current project
     *
     * @see \Rikudou\Installer\Enums\OperationType
     *
     * @return string[]
     */
    public function getTypes(): array;

    /**
     * Returns the directory from which the configuration will be handled.
     * These must be the direct subdirectories of .installer
     *
     * @return string[]
     */
    public function getProjectDirs(): array;

    /**
     * Sets the priority for this project type, matcher will try to match projects in order.
     *
     * Higher priority means that matcher will try this project type sooner.
     *
     * @return int
     */
    public function getPriority(): int;
}
