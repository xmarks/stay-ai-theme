/**
 * Extracts the YouTube video ID from a given URL.
 *
 * This function works with multiple YouTube URL formats including:
 * - https://www.youtube.com/watch?v=VIDEO_ID
 * - https://youtu.be/VIDEO_ID
 * - https://www.youtube.com/embed/VIDEO_ID
 * - https://www.youtube.com/v/VIDEO_ID
 * - https://www.youtube.com/shorts/VIDEO_ID
 *
 * Edge Case Handling:
 * If no match is found, the function will return undefined.
 *
 * Examples of Supported URLs:
 * - https://www.youtube.com/watch?v=61JHONRXhjs&ab_channel=Google
 * - https://youtu.be/61JHONRXhjs?feature=shared
 * - https://www.youtube.com/embed/61JHONRXhjs
 * - https://www.youtube.com/v/61JHONRXhjs
 * - https://www.youtube.com/shorts/61JHONRXhjs
 *
 * @param {string} url - The YouTube URL from which to extract the video ID.
 * @returns {string|undefined} The extracted video ID, or undefined if no match is found.
 */

export const extractYTVideoID = (url) => {
  const regExp =
    /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/)|youtu\.be\/)([^#\&\?]{11})/;
  const match = url.match(regExp);

  return match ? match[1] : undefined;
};
