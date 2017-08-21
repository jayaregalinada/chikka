# Changelog

All Notable changes to [jag/chikka][link-packagist] will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [Unreleased]
- Add handler for receive SMS.
- Add handler for notification
- Add handler for reply to an SMS.
- Add and improved events and listeners.
- Can use without laravel.
- Create test either phpspec or phpunit.

## [0.1.2] - 2017-08-21

### Fixed
- Not found description property on Exception.

## [0.1.1] - 2017-08-20

### Added
- Response for sent message.
- Sender form.
- Multiple error Exceptions.
- Sending Events.
- Sender Interface for basis.

### Fixed
- Package name.
- Minimum stability.

### Changed 
- Use the `.env` instead of creating to services configuration.
- Improved `Chikka::send()` method.

### Removed
- Container for `chikka.client`.
- Receiver class instead wait for the update.
- No more samples.

[link-packagist]: https://packagist.org/packages/jag/chikka
