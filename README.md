# Template Editor

[![Build Status](https://drone.owncloud.com/api/badges/owncloud/templateeditor/status.svg?branch=master)](https://drone.owncloud.com/owncloud/templateeditor) [![codecov](https://codecov.io/gh/owncloud/templateeditor/branch/master/graph/badge.svg)](https://codecov.io/gh/owncloud/templateeditor)

ownCloud comes with a built-in mail service to send various kinds of informative and action-requiring notifications to interact with users 
(e.g., user/group and link share notifications, activity stream summary mails, password reset mails and more). 
By default ownCloud uses pre-defined standard templates for the respective events. 

To meet their exact needs and guidelines many administrators desire to customize and personalize these templates. 
The system administrator can manually edit the template files within the ownCloud code.
The Mail Template Editor provides an easier and more comfortable way for ownCloud administrators to modify mail templates 
within the 'General' section of ownCloud admin settings using HTML or plain text depending on the respective template. 
Each [ownCloud Theme](https://marketplace.owncloud.com/themes) can provide separate templates making it very easy to switch between templates by just enabling a different theme.
For more information, please read the [ownCloud Documentation](https://doc.owncloud.com/server/latest/admin_manual/configuration/server/email_configuration.html#using-email-templates).
