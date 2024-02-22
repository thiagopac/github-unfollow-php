# GitHub Unfollow in PHP

This PHP script automatically unfollows users on GitHub who do not follow you back, with the option to maintain a whitelist of users that you do not want to unfollow.

## Installation

To use this script, you need to have PHP installed on your system. If you do not have PHP installed, you can download it from the [official PHP website](https://www.php.net/downloads.php).

Once PHP is installed, you can clone the repository or download the PHP script to your local machine.

    git clone git@github.com:thiagopac/github-unfollow-php.git

    cd github-unfollow-php

## Creating a Personal Access Token

To authenticate with the GitHub API, you will need to create a Personal Access Token. Follow these steps to create one:

1. Go to your GitHub account settings.

2. Scroll down to the **Developer settings** section and select **Personal access tokens**.

3. Click on the **Generate new token** dropdown and select **Generate new token (classic)**.

4. Give your token a descriptive name.

5. In the **Select scopes** section, ensure that you check the `user` > `user:follow` permission to allow the script to manage following and unfollowing.

6. Once the token is created, make sure to copy it to your clipboard.

**Important:** Treat your tokens like passwords and keep them secret. Do not share your tokens in public spaces, and do not include them in your repository.

## Usage

To run the script, use the following command in the terminal, replacing `<YOUR-TOKEN>` with the Personal Access Token you generated and `user1 user2 user3` with the GitHub usernames you want to keep following (your whitelist):

    php unfollow.php <YOUR-TOKEN> user1 user2 user3

The script will unfollow users who do not follow you back, except for the ones listed in the whitelist.

## Contributing

Contributions to this project are welcome. You can contribute by:

- Suggesting new features

- Submitting pull requests

## License

This project is licensed under the [ISC License](LICENSE.md).

## All script languages

- [GitHub Unfollow in JavaScript](https://github.com/thiagopac/github-unfollow)
- [GitHub Unfollow in TypeScript](https://github.com/thiagopac/github-unfollow-ts)
- [GitHub Unfollow in Go](https://github.com/thiagopac/github-unfollow-go)
- [GitHub Unfollow in Python](https://github.com/thiagopac/github-unfollow-py)
- [GitHub Unfollow in PHP](https://github.com/thiagopac/github-unfollow-php)
