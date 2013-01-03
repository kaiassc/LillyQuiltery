<?php
/**
 * Created by Brad Walker on 9/25/12 at 4:04 PM
*/

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once('application/libraries/Library.php');

class Format extends Library {
	
	/**
	 * returns a title formatted for use in a URL
	 * @param string $title
	 * @return string
	 */
	public function titleForURL($title) {
		return preg_replace('/-{2,}/', '-', preg_replace('/[^a-zA-Z0-9]/', '-', $title));
	}

	/**
	 * returns the URL to the specified texture pack
	 * @param \Entity\TexturePack $texturePack
	 * @return string
	 */
	public function texturePackURL(\Entity\TexturePack $texturePack) {
		return $this->texturePackURLFromProperties($texturePack->getID(), $texturePack->getName());
	}

	/**
	 * returns the URL to the specified texture pack
	 * @param int $packID pack id
	 * @param string $packName pack name
	 * @return string
	 */
	public function texturePackURLFromProperties($packID, $packName) {
		$formattedPackName = $this->titleForURL($packName);
		
		if ($packID === 1) {
			return "pack/{$formattedPackName}";
		}
		else {
			return "pack/{$packID}/{$formattedPackName}";
		}
	}

	/**
	 * returns the resolution from the path string of an image
	 * @param string $displayImagePath the image path
	 * @return array
	 */
	public function resolutionFromImagePath($displayImagePath) {
		preg_match_all('/\d+x\d+.png/', $displayImagePath, $matches);
		
		if (isset($matches[0][0])) {
			$resolutionAndExtension = $matches[0][0]; // ex. 64x64.png

			preg_match_all('/\d+/', $resolutionAndExtension, $matches2);
			
			if (isset($matches2[0])) {
				return $matches2[0];
			}
		}
		
		return NULL;
	}

	/**
	 * returns the URL to the specified user's profile
	 * @param \Entity\User $user
	 * @return string
	 */
	public function userProfileURL(\Entity\User $user) {
		$userID = $user->getID();
		$username = $this->titleForURL($user->getUsername());

		return "user/{$userID}/{$username}";
	}
	
	
	public function bbCode($string) {
		if (FALSE) {
			$youtube = '<img src="images/youtubepreview.png" width="560" height="349" />';
		}
		else {
			$youtube = '<iframe width="560" height="349" class="youtube" src="https://www.youtube.com/embed/$1?showsearch=0&rel=0&hd=1" frameborder="0" allowfullscreen></iframe>';
		}
		
		// Convert all special HTML characters into entities to display literally
		$str = htmlentities($string);
		// The array of regex patterns to look for
		$format_search =  array(
			'#\[b\](.*?)\[/b\]#is', // Bold ([b]text[/b]
			'#\[i\](.*?)\[/i\]#is', // Italics ([i]text[/i]
			'#\[u\](.*?)\[/u\]#is', // Underline ([u]text[/u])
			'#\[s\](.*?)\[/s\]#is', // Strikethrough ([s]text[/s])
			'#\[quote\](.*?)\[/quote\]#is', // Quote ([quote]text[/quote])
			'#\[quote=(.*?)\](.*?)\[/quote\]#is', // Quote w/ quoter ([quote=quoter]text[/quote])
			'#\[code\](.*?)\[/code\]#is', // Monospaced code [code]text[/code])
			'#\[size=(1[0-9]|2[0-9]|3[0-9]|40)\](.*?)\[/size\]#is', // Font size 1-20px [size=20]text[/size])
			'#\[color=\#?([A-F0-9]{3}|[A-F0-9]{6})\](.*?)\[/color\]#is', // Font color ([color=00F]text[/color])

			'#\[center\](.*?)\[/center\]#is', // center align ([center]i love cheese in the middle[/center])
			'#\[left\](.*?)\[/left\]#is', // left align ([left]i love cheese on the left[/left])
			'#\[right\](.*?)\[/right\]#is', // right align ([right]i love cheese on the right[/right])

			'#\[url=((?:ftp|https?)://.*?)\](.*?)\[/url\]#i', // Hyperlink with descriptive text ([url=http://url]text[/url])
			'#\[url\]((?:ftp|https?)://.*?)\[/url\]#i', // Hyperlink ([url]http://url[/url])
			'#\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]#i', // Image ([img]http://url_to_image[/img])
			'#\[gallery\](.*?)\[/gallery\]#is', // image gallery ([gallery][img]http://...[/img][/gallery])
			'#\[youtube\]([a-zA-Z0-9_-]{11})\[/youtube\]#i' // Youtube embed ([youtube]http://url_to_video[/youtube])
		);
		// The matching array of strings to replace matches with
		$format_replace = array(
			'<strong>$1</strong>',
			'<em>$1</em>',
			'<span style="text-decoration: underline;">$1</span>',
			'<span style="text-decoration: line-through;">$1</span>',
			'<blockquote class="bbquote">$1</blockquote>',
			'<blockquote class="bbquote"><p>$2</p><div>- $1</div></blockquote>',
			'<pre>$1</'.'pre>',
			'<span style="font-size: $1px;">$2</span>',
			'<span style="color:#$1;">$2</span>',

			'<div style="text-align:center; margin:3px auto 3px auto;">$1<'.'/div>',
			'<div style="text-align:left;">$1</'.'div>',
			'<div style="text-align:right;">$1</'.'div>',

			'<a href="$1">$2</a>',
			'<a href="$1">$1</a>',
			'<img src="$1" alt="" />',
			'<div class="gallery">$1</'.'div>',
			$youtube
		);
		// Perform the actual conversion
		$str = preg_replace($format_search, $format_replace, $str);
		// Convert line breaks in the <br /> tag
		$str = nl2br($str);
		return $str;
	}
	
	
	public function passwordHash($password) {
		return md5($password);
	}
}
