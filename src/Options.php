<?php

namespace Yt\Dlp;

/**
 * @see https://github.com/yt-dlp/yt-dlp#usage-and-options
 */
enum Options: string
{
    #######################
    #   GENERIC OPTIONS   #
    #######################
    case HELP = "--help";
    case VERSION = "--version";
    case UPDATE = "--update";
    case NO_UPDATE = "--no-update";
    case IGNORE_ERRORS = "--ignore-errors";
    case ABORT_ON_ERROR = "--abort-on-error";
    case NO_ABORT_ON_ERROR = "--no-abort-on-error";
    case DUMP_USER_AGENT = "--dump-user-agent";
    case LIST_EXTRACTORS = "--list-extractors";
    case EXTRACTOR_DESCRIPTIONS = "--extractor-descriptions";
    case USE_EXTRACTORS = "--use-extractors %s";
    case DEFAULT_SEARCH = "--default-search %s";
    case IGNORE_CONFIG = "--ignore-config";
    case NO_CONFIG_LOCATIONS = "--no-config-locations";
    case CONFIG_LOCATION = "--config-location %s";
    case FLAT_PLAYLIST = "--flat-playlist";
    case NO_FLAT_PLAYLIST = "--no-flat-playlist";
    case LIVE_FROM_START = "--live-from-start";
    case NO_LIVE_FROM_START = "--no-life-from-start";
    case WAIT_FOR_VIDEO = "--wait-for-video %s";
    case NO_WAIT_FOR_VIDEO = "--no-wait-for-video";
    case MARK_WATCHED = "--mark-watched";
    case NO_MARK_WATCHED = "--no-mark-watched";
    case NO_COLORS = "--no-colors";
    case COMPAT_OPTIONS = "--compat-options %s";
    case ALIAS = "--alias %s %s";

    #######################
    #   NETWORK OPTIONS   #
    #######################
    case PROXY = "--proxy %s";
    case SOCKET_TIMEOUT = "--socket-timeout %s";
    case SOURCE_ADDRESS = "--source-address %s";
    case _4 = "--force-ipv4";
    case _6 = "--force-ipv6";
    case ENABLE_FILE_URLS = "--enable-file-urls";
    
    ###################
    #   GEO OPTIONS   #
    ###################
    case GEO_VERIFICATION_PROXY = "--geo-verification-proxy %s";
    case GEO_BYPASS = "--geo-bypass";
    case NO_GEO_BYPASS = "--no-geo-bypass";
    case GEO_BYPASS_COUNTRY = "--geo-bypass-country %s";
    case GEO_BYPASS_IP_BLOCK = "--geo-bypass-ip-block %s";
    
    #######################
    #   VIDEO SELECTION   #
    #######################
    case PLAYLIST_ITEMS = "--playlist-items %s";
    case MIN_FILESIZE = "--min-filesize %s";
    case MAX_FILESIZE = "--max-filesize %s";
    case DATE = "--date %s";
    case DATE_BEFORE = "--datebefore %s";
    case DATE_AFTER = "--dateafter %s";
    case MATCH_FILTERS = "--match-filters %s";
    case NO_MATCH_FILTER = "--no-match-filter";
    case NO_PLAYLIST = "--no-playlist";
    case YES_PLAYLIST = "--yes-playlist";
    case AGE_LIMIT = "--age-limit %s";
    case DOWNLOAD_ARCHIVE = "--download-archive %s";
    case NO_DOWNLOAD_ARCHIVE = "--no-download-archive";
    case MAX_DOWNLOADS = "--max-downloads %s";
    case BREAK_ON_EXISTING = "--break-on-existing";
    case BREAK_ON_REJECT = "--break-on-reject";
    case BREAK_PER_INPUT = "--break-per-input";
    case NO_BREAK_PER_INPUT = "--no-break-per-input";
    case SKIP_PLAYLIST_AFTER_ERRORS = "--skip-playlist-after-errors %s";

    ########################
    #   DOWNLOAD OPTIONS   #
    ########################
    case CONCURRENT_FRAGMENTS = "--concurrent-fragments %s";
    case LIMIT_RATE = "--limit-rate %s";
    case THROTTLED_RATE = "--throttled-rase %s";
    case RETRIES = "--retries %s";
    case FILE_ACCESS_RETRIES = "--file-access-retries %s";
    case FRAGMENT_RETRIES = "--fragment-retries %s";
    case RETRY_SLEEP = "--retry-sleep %s";
    case SKIP_UNAVAILABLE_FRAGMENTS = "--skip-unavailable-fragments";
    case ABORT_ON_UNAVAILABLE_FRAGMENT = "--abort-on-unavailable-fragment";
    case KEEP_FRAGMENTS = "--keep-fragments";
    case NO_KEEP_FRAGMENTS = "--no-keep-fragments";
    case BUFFER_SIZE = "--buffer-size %s";
    case NO_RESIZE_BUFFER = "--no-resize-buffer";
    case HTTP_CHUNK_SIZE = "--http-chunk-size %s";
    case PLAYLIST_RANDOM = "--playlist-random";
    case LAZY_PLAYLIST = "--lazy-playlist";
    case NO_LAZY_PLAYLIST = "--no-lazy-playlist";
    case XATTR_SET_FILESIZE = "--xattr";
    case HLS_USE_MPEGTS = "--hls-use-mpegts";
    case NO_HLS_USE_MPEGTS = "--no-hls-use-mpegts";
    case HLS_PREFER_NATIVE = "--hls-prefer-native";
    case DOWNLOAD_SECTIONS = "--download-sections %s";
    case DOWNLOADER = "--downloader %s";
    case DOWNLOADER_ARGS = "--downloader-args %s";
    
    ##########################
    #   FILESYSTEM OPTIONS   #
    ##########################
    case BATCH_FILE = "--batch-file %s";
    case NO_BATCH_FILE = "--no-batch-file";
    case PATHS = "-P";
    case OUTPUT = "--output %s";
    case OUTPUT_NA_PLACEHOLDER = "--output-na-placeholder %s";
    case RESTRICT_FILENAMES = "--restrict-filenames";
    case NO_RESTRICT_FILENAMES = "--no-restrict-filenames";
    case WINDOWS_FILENAMES = "--windows-filenames";
    case NO_WINDOWS_FILENAMES = "--no-windows-filenames";
    case TRIM_FILENAMES = "--trim-filenames %s";
    case NO_OVERWRITES = "--no-overwrites";
    case FORCE_OVERWRITES = "--force-overwrites";
    case CONTINUE = "--continue";
    case NO_CONTINUE = "--no-continue";
    case PART = "--part";
    case NO_PART = "--no-part";
    case MTIME = "--mtime";
    case NO_MTIME = "--no-mtime";
    case WRITE_DESCRIPTION = "--write-description";
    case NO_WRITE_DESCRIPTION = "--no-write-description";
    case WRITE_INFO_JSON = "--write-info-json";
    case NO_WRITE_INFO_JSON = "--no-write-info-json";
    case WRITE_PLAYLIST_METAFILES = "--write-playlist-metafiles";
    case NO_WRITE_PLAYLIST_METAFILES = "--no-rite-playlist-metafiles";
    case CLEAN_INFO_JSON = "--clean-info-json";
    case NO_CLEAN_INFO_JSON = "--no-clean-info-json";
    case WRITE_COMMENTS = "--write-comments";
    case NO_WRITE_COMMENTS = "--no-write-comments";
    case LOAD_INFO_JSON = "--load-info-json %s";
    case COOKIES = "--cookies %s";
    case NO_COOKIES = "--no-cookies %s";
    case COOKIES_FROM_BROWSER = "--cookies-from-browser %s";
    case NO_COOKIES_FROM_BROWSER = "--no-cookies-from-browser";
    case CACHE_DIR = "--cache-dir %s";
    case NO_CACHE_DIR = "--no-cache-dir";
    case RM_CACHE_DIR = "--rm-cache-dir";

    #########################
    #   THUMBNAIL OPTIONS   #
    #########################
    case WRITE_THUMBNAIL = "--write-thumbnail";
    case NO_WRITE_THUMBNAIL = "--no-write-thumbnail";
    case WRITE_ALL_THUMBNAILS = "--write-all-thumbnails";
    case LIST_THUMBNAILS = "--list-thumbnails";

    #################################
    #   INTERNET SHORTCUT OPTIONS   #
    #################################
    case WRITE_LINK = "--write-link";
    case WRITE_URL_LINK = "--write-url-link";
    case WRITE_WEBLOC_LINK = "--write-webloc-link";
    case WRITE_DESKTOP_LINK = "--write-desktop-link";

    ####################################
    #   VERBOSITY/SIMULATION OPTIONS   #
    ####################################
    case QUIET = "--quiet";
    case NO_WARNINGS = "--no-warnings";
    case SIMULATE = "--simulate";
    case NO_SIMULATE = "--no-simulate";
    case IGNORE_NO_FORMATS_ERROR = "--ignore-no-formats-error";
    case NO_IGNORE_NO_FORMATS_ERROR = "--no-ignore-no-formats-error";
    case SKIP_DOWNLOAD = "--skip-download";
    case PRINT = "--print";
    case PRINT_TO_FILE = "--print-to-file %s";
    case DUMP_JSON = "--dump-json";
    case DUMP_SINGLE_JSON = "--dump-single-json";
    case FORCE_WRITE_ARCHIVE = "--force-write-archive";
    case NEWLINE = "--newline";
    case NO_PROGRESS = "--no-progress";
    case PROGRESS = "--progress";
    case CONSOLE_TITLE = "--console-title";
    case PROGRESS_TEMPLATE = "--progress-template %s";
    case VERBOSE = "--verbose";
    case DUMP_PAGES = "--dump-pages";
    case WRITE_PAGES = "--write-pages";
    case PRINT_TRAFFIC = "--print-traffic";
    
    ###################
    #   WORKAROUNDS   #
    ###################
    case ENCODING = "--encoding %s";
    case LEGACY_SERVER_CONNECT = "--legacy-server-connect";
    case NO_CHECK_CERTIFICATE = "--no-check-certificate";
    case PREFER_INSECURE = "--prefer-insecure";
    case ADD_HEADER = "--add-header %s:%s";
    case BIDI_WORKAROUND = "--bidi-workaround";
    case SLEEP_REQUESTS = "--sleep-requests %s";
    case SLEEP_INTERVAL = "--sleep-interval %s";
    case MAX_SLEEP_INTERVAL = "--max-sleep-interval %s";
    case SLEEP_SUBTITLES = "--sleep-subtitles %s";
    
    ############################
    #   VIDEO FORMAT OPTIONS   #
    ############################
    case FORMAT = "--format %s";
    case FORMAT_SORT = "--format-sort %s";
    case FORMAT_SORT_FORCE = "--format-sort-force";
    case NO_FORMAT_SORT_FORCE = "--no-format-sort-force";
    case VIDEO_MULTISTREAMS = "--video-multistreams";
    case NO_VIDEO_MULTISTREAMS = "--no-video-multistreams";
    case AUDIO_MULTISTREAMS = "--audio-multistreams";
    case NO_AUDIO_MULTISTREAMS = "--no-audio-multistreams";
    case PREFER_FREE_FORMATS = "--prefer-free-formats";
    case NO_PREFER_FREE_FORMATS = "--no-prefer-free-formats";
    case CHECK_FORMATS = "--check-formats";
    case CHECK_ALL_FORMATS = "--check-all-formats";
    case NO_CHECK_FORMATS = "--no-check-formats";
    case MERGE_OUTPUT_FORMAT = "--merge-output-format %s";
    
    #########################
    #   SUBTITLES OPTIONS   #
    #########################
    case WRITE_SUBS = "--write-subs";
    case NO_WRITE_SUBS = "--no-write-subs";
    case WRITE_AUTO_SUBS = "--write-auto-subs";
    case NO_WRITE_AUTO_SUBS = "--no-write-auto-subs";
    case LIST_SUBS = "--list-subs";
    case SUB_FORMAT = "--sub-format %s";
    case SUB_LANGS = "--sub-langs %s";
    
    ##############################
    #   AUTHENTICATION OPTIONS   #
    ##############################
    case USERNAME = "--username %s";
    case PASSWORD = "--password %s";
    case TWOFACTOR = "--twofactor %s";
    case NETRC_LOCATION = "--netrc-location %s";
    case VIDEO_PASSWORD = "--video-password %s";
    case AP_MSO = "--ap-mso %s";
    case AP_USERNAME = "--ap-username %s";
    case AP_PASSWORD = "--ap-password %s";
    case AP_LIST_MSO = "--ap-list-mso";
    case CLIENT_CERTIFICATE = "--client-certificate %s";
    case CLIENT_CERTIFICATE_KEY = "--client-certificate-key %s";
    case CLIENT_CERTIFICATE_PASSWORD = "--client-certificate-password %s";

    ###############################
    #   POST PROCESSING OPTIONS   #
    ###############################
    case EXTRACT_AUDIO = "--extract-audio";
    case AUDIO_FORMAT = "--audio-format %s";
    case AUDIO_QUALITY = "--audio-quality %s";
    case REMUX_VIDEO = "--remux-video %s";
    case RECODE_VIDEO = "--recode-video %s";
    case POST_PROCESSOR_ARGS = "--postprocessor-args %s";
    case KEEP_VIDEO = "--keep-video";
    case NO_KEEP_VIDEO = "--no-keep-video";
    case POST_OVERWRITES = "--post-overwrites";
    case NO_POST_OVERWRITES = "--no-post-overwrites";
    case EMBED_SUBS = "--embed-subs";
    case NO_EMBED_SUBS = "--no-embed-subs";
    case EMBED_THUMBNAIL = "--embed-thumbnail";
    case NO_EMBED_THUMBNAIL = "--no-embed-thumbnail";
    case EMBED_METADATA = "--embed-metadata";
    case NO_EMBED_METADATA = "--no-embed-metadata";
    case EMBED_CHAPTERS = "--embed-chapters";
    case NO_EMBED_CHAPTERS = "--no-embed-chapters";
    case EMBED_INFO_JSON = "--embed-info-json";
    case NO_EMBED_INFO_JSON = "--no-embed-info-json";
    case PARSE_METADATA = "--parse-metadata %s";
    case REPLACE_IN_METADATA = "--replace-in-metadata %s";
    case XATTRS = "--xattrs";
    case CONCAT_PLAYLIST = "--concat-playlist %s";
    case FIXUP = "--fixup %s";
    case FFMPEG_LOCATION = "--ffpmeg-location %s";
    case EXEC = "--exec %s";
    case NO_EXEC = "--no-exec";
    case CONVERT_SUBS = "--convert-subs %s";
    case CONVERT_THUMBNAILS = "--convert-thumbnails %s";
    case SPLIT_CHAPTERS = "--split-chapters";
    case NO_SPLIT_CHAPTERS = "--no-split-chapters";
    case REMOVE_CHAPTERS = "--remove-chapters %s";
    case NO_REMOVE_CHAPTERS = "--no-remove-chapters %s";
    case FORCE_KEYFRAMES_AT_CUTS = "--force-keyframes-at-cuts";
    case NO_FORCE_KEYFRAMES_AT_CUTS = "--no-force-keyframes-at-cuts";
    case USE_POSTPROCESSOR = "--use-postprocessor = %s";
    
    ############################
    #   SPONSORBLOCK OPTIONS   #
    ############################
    case SPONSORBLOCK_MARK = "--sponsorblock-mark %s";
    case SPONSORBLOCK_REMOVE = "--sponsor-remove %s";
    case SPONSORBLOCK_CHAPTER_TITLE = "--sponserblock-chapter-title %s";
    case NO_SPONSORBLOCK = "--no-sponsorblock";
    case SPONSORBLOCK_API = "--sponsorblock-api %s";

    #########################
    #   EXTRACTOR OPTIONS   #
    #########################
    case EXTRACTOR_RETRIES = "--extractor-retries %s";
    case ALLOW_DYNAMIC_MPD = "--allow-dynamic-mpd";
    case IGNORE_DYNAMIC_MPD = "--ignore-dynamic-mpd";
    case HLS_SPLIT_DISCONTINUITY = "--hls-split-discontinuity";
    case NO_HLS_SPLIT_DISCONTINUITY = "--no-hls-split-discontinuity";
    case EXTRACTOR_ARGS = "--extractor-args %s";
}