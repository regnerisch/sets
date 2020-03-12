# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Added
- Added changelog entry for 1.0.2

## [1.0.2] - 2020-03-12
### Removed
- wrong `shuffle`-function in `SetTest` (there is a `testShuffle` which is right)

## [1.0.1] - 2019-11-22
### Added
- Some methods did not had a return type, added them 

## [1.0.0] - 2019-11-22
### Added
- Add `chunk` function (`$set->chunk($size)`)
- Add `first` function (`$set->first()`)
- Add `last` function (`$set->last()`)
- Add `reduce` function (`$set->reduce($callable, $initial)`)
- Add `walk` function (`$set->walk($callable, $userdata)`)
- Add `implode` function (`$set->implode($glue)`)
- Add `toJson` function (`$set->toJson($options, $depth)`)

### Changed
- Code is now full PSR2 compatible [#2](https://github.com/regnerisch/sets/pull/2)

## [0.6.0] - 2019-11-21
### Changed
- Complete rewrite of sets. Sets are now handled by `Set` with a special `SetType` which handles type safety. Consider documentation.

## [0.5.0] - 2019-11-20
### Added
- Tests for `InterfaceSet`

### Changed
- Updated README.md

### Removed
- Unnecessary else statement in `addEach`

## [0.4.0] - 2019-11-20
### Added
- `InterfaceSet` which allows to create sets which implement the given interface 

### Fixed
- Fix php7.2 unit test failure [#1](https://github.com/regnerisch/sets/issues/1)
