<?php

class GitHub {
    private $token;
    private $headers;

    public function __construct($token) {
        $this->token = $token;
        $this->headers = [
          "Authorization: Bearer {$this->token}",
          "Accept: application/vnd.github.v3+json",
          "User-Agent: github-unfollow-php/1.0.0"
      ];
    }

    private function request($method, $url, $data = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        if ($method === 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        if ($data !== null && $method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode >= 400) {
            return null;
        }

        curl_close($ch);
        return [
          'body' => json_decode($response, true),
          'status' => $httpCode
        ];
    }

    public function profile() {
      $url = "https://api.github.com/user";
      $response = $this->request('GET', $url);
      return $response['body'];
  }

  public function followedUsers($currentPage = 1) {
      $url = "https://api.github.com/user/following?page={$currentPage}";
      $response = $this->request('GET', $url);
      return $response['body'];
  }

  public function unfollowUser($target) {
      $url = "https://api.github.com/user/following/{$target}";
      $result = $this->request('DELETE', $url);
      if ($result['status'] == 204) {
          echo "Unfollowed {$target}\n";
      } else {
          echo "Error unfollowing {$target}: HTTP status code {$result['status']}\n";
      }
  }

  public function checkFollowBack($target) {
      $profile = $this->profile();    

      if (!$profile) {
          echo "Error getting user profile.\n";
          return false;
      }

      $url = "https://api.github.com/users/{$target}/following/{$profile['login']}";


      $result = $this->request('GET', $url);

      if ($result['status'] == 404) {
          return false;
      } else if ($result['status'] == 204) {
          return true;
      } else {
          return false;
      }
  }
}
