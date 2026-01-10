## Breaking Changes
### Before usage run: `php artisan settings:migrate` to choose the new settings structure.
- View integrator has been removed. Please use the new https://github.com/RealZone22/LaraHooks package
- The WithCustomLivewireException Trait has been removed due to buggy behavior. Please handle exceptions better :)
- Settings are now stored in different tables:
  - `settings` for general settings (not accessible via API!)
  - `public_settings` for public settings (accessible with or without authentication and permissions). Used for API (Mobile, Desktop)
  - `user_settings` for user-specific settings
- New helpers for settings:
    - `settings` to get general settings
    - `publicSettings` to get public settings
    - `userSettings` to get user-specific settings
- Settings must be created before use.
- The multiselect has been updated. Please update it to the new behavior. (https://github.com/RealZone22/PenguBlade/wiki)
