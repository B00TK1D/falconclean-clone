# FalconClean

Laundry room management system

## Installation

```
cd deployment
bash build.sh
```

Note: .env files are required in order to deploy properly for security reasons, .env must be loaded within each container.


## Usage

Generally, application is accessed through QR codes (/q?r=1).

Additionally, the main dashboard is accessible at the root of the application (/), and admin portal is at /admin/dashboard.

*Note: Unfortunately, due to iOS limitations, the original functionality of sending users web push notifications cannot be deployed at the moment.  Web push notifications are currently in beta in iOS, once they are publicly released they will be added with the already-existing API calls.*

## Documentation (For databases class):

I used code which I had previously written for CadetNet, including an extensive PHP framework and deployment system.  All of this code was written by myself solely, over the past year.

No other help received.