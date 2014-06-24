<?php 
// Global
define("LOGIN", 'Login');
define("NEXT", 'Next');
define("PREVIOUS", 'Previous');
define("GAME", 'Game');
define("POINTS", 'points');

// SITEWIDE MODULES
define("POPULAR_MODULE", 'Popular Games');
define("NEWS_MODULE", 'Latest News');
define("NEWEST_MODULE", 'Newest Games');
define("TOP_PLAYERS_MODULE", 'Top Players');
define("NEWEST_MEMBERS_MODULE", 'Newest Members');
define("LINKS_MODULE", 'Links');
define("MORELINKS", 'More links');
define("FEATURED_MODULE", 'Featured Games');
define("USER_AREA_MODULE", 'User Area');
define("NAVIGATION_MODULE", 'Navigation');

// Search box
define("SEARCH_DEFAULT", 'Search games...');

// Pages menu
define("LINKS", 'Links');
define("PAGES_SUBSCRIBE", 'Subscribe');

// User area
define("UA_ADMIN", 'Admin');
define("UA_PROFILE", 'Profile');
define("UA_MESSAGES", 'Messages');
define("UA_LOGOUT", 'Log out');
define("UA_LOGIN", 'Login');
define("UA_REGISTER", 'Register');
define("UA_UNREGISTERED", 'Register to earn points!');

// Homepage
define("HOMEPAGE", 'Homepage');
define("HOME_VIEW_MORE", 'View more');
define("FEATURED_GAMES", 'Featured games');

// Play game page
define("GAME_RATING", 'Overall rating');
define("GAME_YOUR_RATING", 'Your rating');
define("GAME_TIMES_PLAYED", 'Times played');
define("GAME_INFO", 'Game info');
define("GAME_COMMENTS", 'Comments');
define("GAME_MORE_GAMES", 'More games');
define("GAME_FULL_SCREEN", 'Full screen');
define("GAME_FAVOURITE", 'Favourite');
define("GAME_UNFAVOURITE", 'Unfavourite');
define("GAME_DESCRIPTION", 'Description');
define("GAME_INSTRUCTIONS", 'Instructions');
define("GAME_SUBMIT_COMMENT", 'Submit comment');
define("GAME_EMBED", 'Add this game to your site');
define("GAME_PLAYS", 'plays');
define("GAME_LOGIN_TO_RATE", 'Login to rate');
define("GAME_LOGIN_TO_PLAY", 'Please login to continue playing games');
define("GAME_ADD_A_COMMENT", 'Add a comment');
define("GAME_LOGIN_COMMENT", 'Log-in to add a comment');

// Category page
define("CATEGORY_NO_GAMES", 'This category has no games in it!');
define("CATEGORY_SORT_BY", 'Sort options');
define("CATEGORY_NEWEST", 'Newest');
define("CATEGORY_OLDEST", 'Oldest');
define("CATEGORY_AZ", 'A-Z');
define("CATEGORY_ZA", 'Z-A');
define("CATEGORY_RATING", 'Top Rated');
define("CATEGORY", 'Category');

// News
define("NEWS", 'News');
define("POSTBY", 'Posted by');

// Member list
define("MEMBER_LIST", 'Member list');
define("ML_USERNAME", 'Username');
define("ML_POINTS", 'Points');
define("ML_JOIN_DATE", 'Join date');

// User profile
define("PROFILE", 'Profile');
define("PROFILE_POINTS", 'Points');
define("PROFILE_RATINGS", 'Game ratings');
define("PROFILE_PLAYS", 'Game plays');
define("PROFILE_COMMENTS", 'Game comments');
define("PROFILE_EDIT", 'Edit your profile');
define("PROFILE_SEND_MESSAGE", 'Send a message');
define("PROFILE_FAV_GAMES_HEADER", "'s favourite games"); // Username's favourite games
define("PROFILE_COMMENTS_HEADER", "'s latest comments");  // Username's latest comments
define("PROFILE_LOCATION", 'Location');
define("PROFILE_BIO", 'Bio');
define("PROFILE_WEBSITE", 'Website');
define("PROFILE_JOINED", 'Joined');
define("PROFILE_NO_INFO", 'No information');
define("PROFILE_NO_FAVS", 'No favourite games yet');
define("PROFILE_NO_COMMENTS", 'hasn\'t left a comment yet!'); // Username hasn't left a comment yet

// Private messages
define("MESSAGES", 'Personal Messages');
define("PM_SUBJECT", 'Subject');
define("PM_FROM", 'From');
define("PM_DATE", 'Date sent');
define("PM_REPLY", 'Reply');
define("PM_SENDER_PROFILE", 'Sender profile');
define("PM_DELETE_MESSAGE", 'Delete message');
define("PM_MARK_UNREAD", 'Mark unread');
define("PM_SENDING", 'Sending message to'); // Sending message to 'username'
define("PM_MESSAGE", 'Message');
define("PM_SEND_MESSAGE", 'Send message');
define("PM_DELETED", 'Message deleted');
define("PM_MAU", 'Message marked as unread');
define("PM_NO_MESSAGES", 'You have no messages');
define("PM_LOGIN", 'Please log-in to view and send messages');


// Login page
define("LOGIN_BUTTON", 'Login');
define("LOGIN_USERNAME", 'Username');
define("LOGIN_PASSWORD", 'Password');
define("LOGIN_REMEMBER_ME", 'Keep me logged in');
define("LOGIN_FORGOT_PASSWORD", 'Forgotten your password?');
define("LOGIN_ERROR1", 'You didn\'t enter a username and password');
define("LOGIN_ERROR2", "Could not log you in. Please make sure your username and password are correct and that you have validated your account");

// Register page
define("REGISTER", 'Register');
define("REGISTER_USERNAME", 'Username');
define("REGISTER_EMAIL", 'Your email address');
define("REGISTER_PASSWORD", 'Password');
define("REGISTER_PASSWORD2", 'Retype password');
define("REGISTER_BUTTON", 'Register');
define("REG_ERROR1", 'Please make sure that you have correctly filled in all of the fields');
define("REG_ERROR2", 'You must enter a valid alphanumeric username');
define("REG_ERROR3", 'You must enter a password');
define("REG_ERROR4", 'Your passwords did not match');
define("REG_ERROR5", 'Your email address has already been used to sign up for another account!');
define("REG_ERROR6", 'Please fix the following errors');
define("REG_ERROR7", 'Sorry, that username is already taken');
define("REG_ERROR8", 'You must enter an email address');

define("REG_EMAIL_SUBJECT", 'Your registration at'); // Your registration at 'site name'
define("REG_EMAIL1", 'Thank you for registering at'); // Thank you for registering at 'site name'
define("REG_EMAIL2", 'To activate your membership please go here'); // Followed by URL
define("EMAIL4", 'A link to activate your account has been sent to your email address');
define("EMAIL5", 'Account registered! You can now log-in!');

// Lost password
define("LOST_PASS", 'Password reset');
define("LP_EMAIL", 'Your email address');
define("LP_BUTTON1", 'Send reset email');
define("LP_EMAIL1", 'This email is a response to your lost password request. If you did not initiate this password reset you should not take any further action');
define("LP_EMAIL2", 'To reset your password please click the following link and enter your new password:');
define("LP_EMAIL_SENT", 'An email has been sent to you that allows you to reset your password');
define("LP_ERROR1", 'Sorry, no account found with that email address');
define("LP_MSG1", 'Please enter your new password');
define("LP_ERROR2", 'Invalid details');
define("LP_SUCCESS", 'Your password has been reset');
define("LP_ERROR3", "Your two passwords didn't match");
define("LP_PASSWORD", 'Password');
define("LP_PASSWORD2", 'Repeat password');
define("LP_BUTTON2", 'Change password');

// Edit profile 
define("EDIT_PROFILE", 'Edit profile');
define("EP_EDIT_AVATAR", 'Edit avatar');
define("EP_AVATAR_UP", 'Upload new avatar image');
define("EP_AVATAR_RESTRICTIONS", 'Images should be in jpeg, png or gif format and no larger than 300x300 pixels');
define("EP_AVATAR_BUTTON", 'Upload avatar');
define("EP_TITLE", 'Edit your info');
define("EP_LOCATION", 'Location');
define("EP_INTERESTS", 'Interests');
define("EP_ABOUT", 'About me');
define("EP_WEBSITE", 'Website');
define("EP_BUTTON", 'Save changes');
define("PROFILE_UPDATED", 'Your profile has been updated');

define("AV_SUCCESS", 'Avatar successfully uploaded');
define("AV_ERROR1", 'Error: A problem occurred during file upload!');
define("AV_ERROR2", 'Please upload images 300x300 or smaller');
define("AV_ERROR3", 'Please upload images 1mb or smaller');
define("AV_ERROR4", 'Error: Only .jpg/.jpeg, .gif and .png are accepted for upload.');
define("AV_ERROR5", 'Error: No file uploaded');

// Validate signup
define("NO_VALIDATE", 'Your account could not be validated');
define("VALIDATED", 'Your account is active, you can now login');

// Search
define("NO_SEARCH", 'Please type a valid search');
define("NOSEARCH", 'You did not say what you wanted to search for');
define("TOO_MANY", 'Too many results", please extend your search');
define("NORESULTS", 'Sorry, no results');
define("ENTER_SEARCH", 'Please enter a search');
define("SEARCH_BUTTON", 'Search');
define("NOT_RATED", 'N/A');
define("SEARCH_RESULTS", 'Search results for'); // Search results for SEARCH QUERY

// News comments
define("NEWS_COMMENTS", 'News comments');
define("NEWS_COMMENTS2", 'comments');

// NEW STUFF
define("GAME_ADDED", 'Date added');
define("DATE_UNKNOWN", 'Unknown');

define("FAVOURITE_MODULE", 'Your Favourites');
define("FAVOURITES_LOG_IN", 'Log-in to save favourites');
define("FAVOURITES_VIEW_ALL", 'View all');

// TAGS
define("TAG_TITLE", 'Games tagged as');
define("GAME_TAGS", 'Tags');
define("NO_TAGS", 'None');
define("TAGS_MODULE", 'Game Tags');

// Referrer
define("REF_PM_TITLE", 'is now on'); // USERNAME is now on SITE NAME
define("REF_PM_MESSAGE", 'has signed up using your referral link. See their profile here'); // USERNAME has signed up...

// Login with Facebook
define("FB_LOGIN", 'Login with Facebook');
define("FB_LOGOUT", 'Logout');
define("FB_REGERROR1", 'Sorry, that username is already in use');
define("FB_REGERROR2", 'Please enter a username');
define("FB_USERNAME", 'New username');
define("FB_REGISTER", 'Login with Facebook');
define("FB_HELLO", 'Hello');
define("FB_INFO", 'All we need is for you to select a username and you\'ll be signed-up and ready to go!');
define("FB_INVALID", 'No facebook login');

// Reports
define("GAME_REPORT_TITLE", 'Please give a brief description of what is wrong with the game');
define("COMMENT_REPORT_TITLE", 'Please give a brief description of what is wrong with the comment');
define("GAME_SUBMIT_REPORT", 'Submit report');
define("GAME_REPORT", 'Report Game');
define("GAME_CLOSE_REPORT", 'Cancel');
define("REPORT", 'Report');

// Page not found
define("PAGE_NOT_FOUND", 'Page not found');
define("PAGE_NOT_FOUND_INFO", 'Sorry, we couldn\'t find anything at the url you entered. The page may have been previously existed but is no longer active.');

// Highscores
define("GAME_HIGHSCORES", 'Highscores');
define("HIGHSCORE_ENABLED", 'Highscore enabled');
define("HIGHSCORE_NONE", 'No highscores yet');
define("HIGHSCORE_USER", 'Player');
define("HIGHSCORE_SCORE", 'Score');
define("HIGHSCORE_DATE", 'Date set');
define("USER_HIGHSCORES", 'Recent highscores');

// 5.4.4 Updates
define("EXIT_FULLSCREEN", 'Exit fullscreen');
define("SHARE_INFO", 'Share on social sites and earn points');
define("SHARE_MESSAGE", 'I have been playing this great game');
define("YOUR_URL_TITLE", 'Your unique referral url');
define("PRELOAD_INFO", 'Advertisement: Your game is loading');
define("CLICK_TO_SKIP", 'click here to skip');

///////////////////////////
// New in 5.5
///////////////////////////

// Submit a game
define("SUBMIT", 'Submit');
define("CONTINUE_BUTTON", 'Continue to game upload');

define("SUBMIT_GAME", 'Submit a game');
define("SUBMIT_NAME", 'Game name');
define("SUBMIT_DESC", 'Description');
define("SUBMIT_INSTRUCTIONS", 'Instructions');
define("SUBMIT_TAGS", 'Tags');
define("SUBMIT_IMG", 'Thumbnail image');
define("SUBMIT_THUMBNAIL_MESSAGE", 'Upload an image file to represent your game, must be 80x80 or higher');
define("SUBMIT_FILE", 'File');
define("SUBMIT_CAT", 'Category');

define("SUBMIT_SUCCESS", 'Thanks for your submission, feel free to add another below');
define("SUBMIT_E", 'Sorry, a problem occurred during file upload');
define("SUBMIT_E_SIZE", 'Please upload images 1mb or smaller');
define("SUBMIT_E_FILETYPE", 'Filetype is not valid, accepted filetypes:');
define("SUBMIT_E_NOFILE", 'Please select a file to upload');
define("SUBMIT_E_UNFILLED", 'You have left a required field blank');
define("SUBMIT_E_NOLOGIN", 'Register or login to submit a game');
define("SUBMIT_E_DISABLED", 'Submissions are disabled');

define("SUBMIT_PARTIAL", 'Uncompleted submission found');
define("SUBMIT_PARTIAL_LINK", 'Click here to complete submission');

define("SUBMIT_FILE_MESSAGE", 'Upload your game\'s swf file');
define("FILE_DISCLAIMER", 'By uploading a game you confirm you are the owner of the game and you have full rights to distribute it and the assets contained within the game. You are granting permission for us to display and distribute your game on our site.');

// Categories
define("CATEGORY_SUBCATS", 'Sub-categories');
define("CATEGORY_PLAYS", 'Most Played');
define("CATEGORY_HIGHSCORES", 'Highscore enabled');

// Profile
define("PROFILE_SUBMITTED_GAMES_HEADER", '\'s submitted games');
define("NO_SUBMITTED_GAMES", 'No games submitted');

// Friends
define("UA_FRIENDS", 'Friends');
define("UA_FRIENDS_1NEW", 'friend request'); // X friend requests
define("UA_FRIENDS_NEW", 'friend requests'); // X friend requests

define("FRIENDS", 'Friends');
define("UNFRIENDED", 'Friend removed');
define("REQUEST_SENT", 'Request sent');

define("ADD_FRIEND", 'Add friend');
define("UNFRIEND", 'Unfriend');

define("LAST_ACTIVITY", 'Last active');

define("FRIENDS_HIGHSCORE_NONE", 'No friends have set a highscore for this game');
define("DELETE_FRIEND_CONFIRM", 'Are you sure you want to delete this friend?');
define("NO_FRIENDS", 'You haven\'t added any friends yet');
define("FRIENDS_LOGIN", 'Login to view your friends list');

// Link exchange
define("LINK_EXCHANGE", 'Link exchange');
define("LINK_EXCHANGE_INFO", 'Submit your link below and we\'ll generate a unique referral URL for you to add to your site. When we confirm your link is up, we\'ll add yours');
define("LINK_EXCHANGE_STEP2", 'Thanks for your submission. Remember this is a link exchange so you will need to add our link to your site. Below is your unique link that will allow us to track incoming hits from you. Make sure to use it! There\'s a description if you need it.');
define("LINK_EXCHANGE_ERROR", 'Please make sure to fill in all of the fields');

define("LINK_EXCHANGE_UL", 'HTML code');

define("LINK_EXCHANGE_ANCHOR", 'Anchor');
define("LINK_EXCHANGE_DESCRIPTION", 'Description');
define("LINK_EXCHANGE_URL", 'URL');
define("LINK_EXCHANGE_EMAIL", 'Email');

define("OUR_FRIENDS", 'Our friends');

// Emails
define("EMAIL_FR_HEADING", 'You have a new friend request');
define("EMAIL_ACCEPT_FRIEND_REQUEST", 'Accept friend request');
define("EMAIL_GREETING", 'Hi'); // Hi <username>
define("EMAIL_FR_INTRO", 'has added you as a friend'); // <username> has added you as a friend
define("EMAIL_USER_JOINED", 'Joined');
define("EMAIL_FOOTER", 'You can edit email settings in your account settings');

define("EMAIL_MESSAGE_INTRO", 'has sent you a message'); // <username> has added you as a friend
define("EMAIL_OPEN_MESSAGES", 'Message center');

define("EMAIL_PASSWORD_HEADER", 'Password reset request');
define("EMAIL_PASSWORD_INTRO", ', you requested a password reset. If you did not, no further action need to be taken and you can ignore this email.');
define("EMAIL_PASSWORD_IP", 'Request sent from IP');
define("EMAIL_PASSWORD_RESET_LINK", 'Click here to set a new password');

define("EMAIL_REGISTER_HEADER", 'Thanks for registering'); // Thanks for registering <username>
define("EMAIL_REGISTER_INTRO", 'thanks for registering');
define("EMAIL_REGISTER_VINFO", 'You just need to click the link below to activate your account');
define("EMAIL_REGISTER_VALIDATE", 'Validate email address');

define("EMAIL_PLAY_GAME", 'Play game');

// Email settings
define("EMAIL_SETTINGS", 'Email settings');
define("ES_NEW_MESSAGE", 'New private message');
define("ES_FRIEND_REQUEST", 'Friend request');
define("ES_HIGHSCORE_CHALLENGE", 'Highscore challenge');

// Challenge a friend
define("CHALLENGE_HEADING", 'Challenge a friend');
define("CHALLENGE_LABEL", 'Challenge');
define("CHALLENGE_LEADERBOARD_LABEL", 'To beat'); // Challenge <user> to beat <highscore>
define("CHALLENGE_NEWEST", 'Your newest score');
define("CHALLENGE_BEST", 'Your best score');
define("CHALLENGE_SUBMIT", 'Challenge friend');
define("CHALLENGE_CLOSE", 'Cancel');

define("CHALLENGE_SUBMITTED", 'Challenge sent');
define("CHALLENGE_ANOTHER", 'Challenge another friend');

define("CHALLENGE_PM_SUBJECT1", 'Try to beat my score of');
define("CHALLENGE_PM_SUBJECT2", 'on'); // Try to beat my score of <score> on <game name>

define("CHALLENGE_PM_GREETING1", 'Hello');
define("CHALLENGE_PM_GREETING2", 'has challenged you to beat their highscore');

define("CHALLENGE_A_FRIEND", 'Challenge a friend');
define("CHALLENGE_A_FRIEND_LONG", 'Challenge a friend to beat your highscore');

define("HIGHSCORE_SUBMITTED", 'Highscore submitted');
define("HIGHSCORE_ALREADY_SUBMITTED", 'You have a highscore on this game');

define("CHALLENGE_NOSCORE", 'You dont have a highscore for this game yet!');

// 5.5 Misc
define("ALL_GAMES", 'All Games');
define("LEADERBOARD", 'Leaderboard');
define("LOADING", 'Loading');
define("BANNED_MSG", 'Your account has been banned');
define("ERROR_MESSAGE", 'Error');

define("INVALID_LOGIN1", 'New password set: Please');
define("INVALID_LOGIN2", 'and then login with your new password.'); // New password set: Please <LOGOUT> and then login with your new password

define("PM_FLOOD_CONTROL", 'Please wait 60 seconds between sending PM\'s');

define("GAME_SUBMITTER", 'Submitted by');

// Highscore additions
define("HIGHSCORES_ALL", 'All');
define("HIGHSCORES_FRIENDS", 'Friends');
define("HIGHSCORES_SHOW", 'Show');

// GENERAL FORUM
define("FORUM", 'Forum');
define("FORUMS", 'Forums');
define("TOPIC", 'Topic');
define("TOPICS", 'Topics');
define("REPLIES", 'Replies');
define("POSTS", 'Posts');
define("VIEWS", 'Views');
define("PAGE", 'Page');
define("STATS", 'Stats');
define("EDITED", 'Edited');
define("EDITED_BY", 'Edited by');
define("POSTED", 'Posted');
define("DELETE", 'Delete');
define("EDIT", 'Edit');
define("QUOTE", 'Quote');
define("LOCKED", 'Locked');
define("CANCEL", 'Cancel');
define("SUB_FORUMS", 'Sub-forums');
define("FORUM_SEARCH", 'Forum search');
define("TOTAL_POSTS", 'Posts');
define("NOT_LOGGED_IN", 'Your login has expired, please login again to continue');

define("ERROR_FLOOD_CONTROL1", 'Flood control enabled: Please wait'); // Flood control enabled: Please wait <total> seconds between posts
define("ERROR_FLOOD_CONTROL2", 'seconds between posts');

// Forums display
define("LAST_POST_INFO", 'Last post info');
define("POSTED_BY", 'by');
define("OPEN_TOPIC", 'Open topic');
define("TP_STARTED", 'started the topic'); // USERNAME started the topic
define("TP_LAST_POST", 'made the last post'); // USERNAME made the last post
define("FORUM_SEARCH_BOX", 'Search this forum...'); 
define("NEW_TOPIC", 'New Topic'); 
define("LOGIN_TO_START", 'Log-in to start a topic'); 
define("NO_TOPICS", 'There are no topics in this forum yet'); 
define("INVALID_FORUM", 'Forum does not exist or is read-only');

// Post Reports
define("POST_REPORT_TITLE", 'Please state the reason for reporting this post'); 

// Forum / Search results
define("LAST_POST_BY", 'Last post by');

// Topic
define("SUBMIT_REPLY", 'Submit reply');
define("ADD_REPLY", 'Add Reply');
define("LOGIN_TO_REPLY", 'Log-in to reply');
define("TOPIC_SEARCH_BOX", 'Search this topic...'); 
define("EDITING_POST", 'Editing post'); // Editing post #1 etc
define("JUST_NOW", 'Just now'); // Post edited: Just now
define("REPORT_POST", 'Report Post'); // Post edited: Just now
define("NP_LAST_PAGE", 'Your post will appear on the last page');

define("ERROR_TOPIC_LOCKED", 'Sorry, this topic has been locked');
define("ERROR_NOT_LOGGED_IN", 'Your login has expired, please log-in again. Login in a new tab and return here to post');

// FORUM SEARCH
define("FS_ALL", 'All forums');
define("FS_SUBF", 'Search sub-forums');
define("FS_TITLES", 'Search topic titles only');
define("FS_RANGE", 'Show posts from the last');
define("FS_TOPICID", 'Topic ID');
define("FS_SEARCH_FOR", 'Search for');
define("FS_POSTED_BY", 'Posted by');
define("FS_SHOW", 'Show');
define("FS_HOURS", 'Hours');
define("FS_DAYS", 'Days');
define("FS_WEEKS", 'Weeks');
define("FS_MONTHS", 'Months');

/* FORUM VIEW */
define("TOPIC_CREATED_BY", 'created by');

// FORUM EDITOR */
define("BB_BOLD", 'Bold');
define("BB_ITALICS", 'Italics');
define("BB_UNDERLINE", 'Underline');
define("BB_FONT", 'Font');
define("BB_SIZE", 'Font Size');
define("BB_COLOUR", 'Font Colour');
define("BB_IMAGE", 'Image');
define("BB_LINK", 'URL');
define("BB_LIST", 'List');
define("BB_ALIGN", 'Text Alignment');
define("BB_QUOTE", 'Quote');
define("BB_CODE", 'Code');
define("BB_EMOTICONS", 'Emoticons');
define("BB_REMOVE_LINK", 'Remove URL');

define("BB_IMAGE_URL", 'Image URL');
define("BB_TITLE", 'Link anchor');
define("BB_INSERT", 'Insert');
define("BB_CANCEL", 'Cancel');

define("BB_DISC", 'Disc');
define("BB_CIRCLE", 'Circle');
define("BB_SQUARE", 'Square');
define("BB_DECIMAL", 'Numbered');

define("BB_LEFT", 'Left');
define("BB_CENTER", 'Center');
define("BB_RIGHT", 'Right');

// NEW 5.7
define("FORUM_POSTS", 'Forum posts');
define("REPORT_USER", 'Report user');
define("USER_REPORT_TITLE", 'Please state the reason for reporting this user');
define("NEWS_HOME", 'News home');
define("OPTIONAL_LOGIN", 'Or:'); // Login register OR Facebook connect

define("NOT_SET", 'Not set'); // Login register OR Facebook connect

define("SIGNATURE_SETTINGS", 'Forum signature');
define("PROFILE_SIGNATURE_HEADER", 'Forum signature');
define("FILL_IN_FORM", 'Please make sure you\'ve filled in the required fields');

define("PM_NO_SUBJECT", 'No subject');
define("PM_MESSAGE_SENT", 'Message sent');
define("PM_RETURN_TO_PROFILE", 'Return to user profile');
define("PM_RETURN_TO_INBOX", 'Go to inbox');
define("PM_REPORT", 'Report PM');
define("PM_REPORT_TITLE", 'Please state the reason for reporting this message');
define("PM_NOT_YOURS", 'That message was not sent to you');

/* Notifications */
define("N_POINTS_EARNED1", 'You earned');
define("N_POINTS_EARNED2", 'points');

define("N_POINTS_EARNED_RATING", 'for rating a game');
define("N_POINTS_EARNED_PLAY", 'for playing a game');
define("N_POINTS_EARNED_COMMENT", 'for posting a comment');
define("N_POINTS_EARNED_HIGHSCORE", 'for getting a highscore');
define("N_ALREADY_SUBMITTED", 'You have already submitted that score');
define("N_POINTS_EARNED_HS_LINK", 'Challenge a friend');
define("N_POINTS_EARNED_CHALLENGE", 'for challenging a friend');
define("N_POINTS_EARNED_POST", 'for replying to a topic');
define("N_POINTS_EARNED_TOPIC", 'for starting a topic');
define("N_NO_POINTS", 'Sorry, you\'re earning points too fast to get any this time');
define("N_MARKED_READ", 'Forum marked as read');

define("N_TICKETS1", 'You have');
define("N_TICKETS2", 'plays remaining before you must register'); // You have <Number> plays remaining before you must register

define("N_ONE_NEW_PM", 'You have a new private message');
define("N_MULTIPLE_NEW_PMS1", 'You have');
define("N_MULTIPLE_NEW_PMS2", 'unread private messages');
define("N_ONE_NEW_FR", 'You have a new friend request');
define("N_MULTIPLE_NEW_FRS1", 'You have');
define("N_MULTIPLE_NEW_FRS2", 'new friend requests');
define("N_VIEW", 'View');

define("N_COMMENT_FAST", 'Please wait at least 60 seconds between comments');
?>