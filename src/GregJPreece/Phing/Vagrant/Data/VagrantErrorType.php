<?php

namespace GregJPreece\Phing\Vagrant\Data;

use MyCLabs\Enum\Enum;

/**
 * Types of error that may be returned by Vagrant in the CLI.
 * These are easily located in the Vagrant source code:
 * /lib/vagrant/errors.rb
 * @author Greg J Preece <greg@preece.ca>
 */
class VagrantErrorType extends Enum {
    
    /**
     * An active machine with the same name as requested
     * exists, but the provider specified for it does not match
     * the request
     */
    const ACTIVE_MACHINE_WITH_DIFFERENT_PROVIDER = 'Vagrant::Errors::ActiveMachineWithDifferentProvider';
    
    /**
     * Aliases specified must not contain whitespace
     */
    const ALIAS_INVALID = 'Vagrant::Errors::AliasInvalidError';
    
    /**
     * A set of errors encountered while processing a batch command
     */
    const BATCH_MULTI = 'Vagrant::Errors::BatchMultiError';
    
    // @TODO: Document when the rest of these happen and update the Vagrant site docs too
    // Maybe do this when you're bored or watching TV or something
    const BOX_ADD_DIRECT_VERSION = 'Vagrant::Errors::BoxAddDirectVersion';
    
    const BOX_ADD_METADATA_MULTI_URL = 'Vagrant::Errors::BoxAddMetadataMultiURL';
    
    const BOX_ADD_NAME_MISMATCH = 'Vagrant::Errors::BoxAddNameMismatch';
    
    const BOX_ADD_NAME_REQUIRED = 'Vagrant::Errors::BoxAddNameRequired';
    
    const BOX_ADD_NO_MATCHING_PROVIDER = 'Vagrant::Errors::BoxAddNoMatchingProvider';
    
    const BOX_ADD_NO_MATCHING_VERSION = 'Vagrant::Errors::BoxAddNoMatchingVersion';
    
    const BOX_ADD_SHORT_NOT_FOUND = 'Vagrant::Errors::BoxAddShortNotFound';
    
    const BOX_ALREADY_EXISTS = 'Vagrant::Errors::BoxAlreadyExists';
    
    const BOX_CHECKSUM_INVALID_TYPE = 'Vagrant::Errors::BoxChecksumInvalidType';
    
    const BOX_CHECKSUM_MISMATCH = 'Vagrant::Errors::BoxChecksumMismatch';
    
    const BOX_CONFIG_CHANGING_BOX = 'Vagrant::Errors::BoxConfigChangingBox';
    
    const BOX_FILE_NOT_EXIST = 'Vagrant::Errors::BoxFileNotExist';
    
    const BOX_METADATA_CORRUPTED = 'Vagrant::Errors::BoxMetadataCorrupted';
    
    const BOX_METADATA_DOWNLOAD_ERROR = 'Vagrant::Errors::BoxMetadataDownloadError';
    
    const BOX_METADATA_FILE_NOT_FOUND = 'Vagrant::Errors::BoxMetadataFileNotFound';
    
    const BOX_METADATA_MALFORMED = 'Vagrant::Errors::BoxMetadataMalformed';
    
    const BOX_METADATA_MALFORMED_VERSION = 'Vagrant::Errors::BoxMetadataMalformedVersion';
    
    const BOX_NOT_FOUND = 'Vagrant::Errors::BoxNotFound';
    
    const BOX_NOT_FOUND_WITH_PROVIDER = 'Vagrant::Errors::BoxNotFoundWithProvider';
    
    const BOX_NOT_FOUND_WITH_PROVIDER_AND_VERSION = 'Vagrant::Errors::BoxNotFoundWithProviderAndVersion';
    
    const BOX_PROVIDER_DOES_NOT_MATCH = 'Vagrant::Errors::BoxProviderDoesntMatch';
    
    const BOX_REMOVE_NOT_FOUND = 'Vagrant::Errors::BoxRemoveNotFound';
    
    const BOX_REMOVE_PROVIDER_NOT_FOUND = 'Vagrant::Errors::BoxRemoveProviderNotFound';
    
    const BOX_REMOVE_VERSION_NOT_FOUND = 'Vagrant::Errors::BoxRemoveVersionNotFound';
    
    const BOX_REMOVE_MULTI_PROVIDER = 'Vagrant::Errors::BoxRemoveMultiProvider';
    
    const BOX_REMOVE_MULTI_VERSION = 'Vagrant::Errors::BoxRemoveMultiVersion';
    
    const BOX_SERVER_NOT_SET = 'Vagrant::Errors::BoxServerNotSet';
    
    const BOX_UNPACKAGE_FAILURE = 'Vagrant::Errors::BoxUnpackageFailure';
    
    const BOX_UPDATE_MULTI_PROVIDER = 'Vagrant::Errors::BoxUpdateMultiProvider';
    
    const BOX_UPDATE_NO_METADATA = 'Vagrant::Errors::BoxUpdateNoMetadata';
    
    const BOX_VERIFICATION_FAILED = 'Vagrant::Errors::BoxVerificationFailed';
    
    const BUNDLER_DISABLED = 'Vagrant::Errors::BundlerDisabled';
    
    const BUNDLER_ERROR = 'Vagrant::Errors::BundlerError';
    
    const MAC_ADDRESS_READ_FAILURE = 'Vagrant::Errors::CantReadMACAddresses';
    
    const CAPABILITY_HOST_EXPLICIT_NOT_DETECTED = 'Vagrant::Errors::CapabilityHostExplicitNotDetected';
    
    const CAPABILITY_HOST_NOT_DETECTED = 'Vagrant::Errors::CapabilityHostNotDetected';
    
    const CAPABILITY_INVALID = 'Vagrant::Errors::CapabilityInvalid';
    
    const CAPABILITY_NOT_FOUND = 'Vagrant::Errors::CapabilityNotFound';
    
    const CF_ENGINE_BOOTSTRAP_FAILED = 'Vagrant::Errors::CFEngineBootstrapFailed';
    
    const CF_ENGINE_CANNOT_DETECT_IP = 'Vagrant::Errors::CFEngineCantAutodetectIP';
    
    const CF_ENGINE_INSTALL_FAILED = 'Vagrant::Errors::CFEngineInstallFailed';
    
    const CF_ENGINE_NOT_INSTALLED = 'Vagrant::Errors::CFEngineNotInstalled';
    
    const CLI_INVALID_USAGE = 'Vagrant::Errors::CLIInvalidUsage';
    
    const CLI_INVALID_OPTIONS = 'Vagrant::Errors::CLIInvalidOptions';
    
    const CLONE_NOT_FOUND = 'Vagrant::Errors::CloneNotFound';
    
    const CLONE_MACHINE_NOT_FOUND = 'Vagrant::Errors::CloneMachineNotFound';
    
    const COMMAND_DEPRECATED = 'Vagrant::Errors::CommandDeprecated';
    
    const COMMAND_SUSPEND_ALL_ARGS = 'Vagrant::Errors::CommandSuspendAllArgs';
    
    const COMMAND_UNAVAILABLE = 'Vagrant::Errors::CommandUnavailable';
    
    const COMMAND_UNAVAILABLE_WINDOWS = 'Vagrant::Errors::CommandUnavailableWindows';
    
    const COMMUNICATOR_NOT_FOUND = 'Vagrant::Errors::CommunicatorNotFound';
    
    const CONFIG_INVALID = 'Vagrant::Errors::ConfigInvalid';
    
    const CONFIG_UPGRADE_ERRORS = 'Vagrant::Errors::ConfigUpgradeErrors';
    
    const COPY_PRIVATE_KEY_FAILED = 'Vagrant::Errors::CopyPrivateKeyFailed';
    
    const CORRUPT_MACHINE_INDEX = 'Vagrant::Errors::CorruptMachineIndex';
    
    const DARWIN_MOUNT_FAILED = 'Vagrant::Errors::DarwinMountFailed';
    
    const DESTROY_REQUIRES_FORCE = 'Vagrant::Errors::DestroyRequiresForce';
    
    const DOTFILE_UPGRADE_JSON_ERROR = 'Vagrant::Errors::DotfileUpgradeJSONError';
    
    const DOWNLOAD_ERROR = 'Vagrant::Errors::DownloaderError';
    
    const DOWNLOAD_INTERRUPTED = 'Vagrant::Errors::DownloaderInterrupted';
    
    const DOWNLOAD_CHECKSUM_ERROR = 'Vagrant::Errors::DownloaderChecksumError';
    
    const ENVIRONMENT_INVALID = 'Vagrant::Errors::EnvInval';
    
    const ENVIRONMENT_NON_EXISTENT_WORKING_DIR = 'Vagrant::Errors::EnvironmentNonExistentCWD';
    
    const ENVIRONMENT_LOCKED = 'Vagrant::Errors::EnvironmentLockedError';
    
    const HOME_DIRECTORY_LATER_VERSION = 'Vagrant::Errors::HomeDirectoryLaterVersion';
    
    const HOME_DIRECTORY_NOT_ACCESSIBLE = 'Vagrant::Errors::HomeDirectoryNotAccessible';
    
    const HOME_DIRECTORY_UNKNOWN_VERSION = 'Vagrant::Errors::HomeDirectoryUnknownVersion';
    
    const HYPER_V_VIRTUALBOX_ERROR = 'Vagrant::Errors::HypervVirtualBoxError';
    
    const FORWARD_PORT_ADAPTER_NOT_FOUND = 'Vagrant::Errors::ForwardPortAdapterNotFound';
    
    const FORWARD_PORT_AUTOLIST_EMPTY = 'Vagrant::Errors::ForwardPortAutolistEmpty';
    
    const FORWARD_PORT_COLLISION = 'Vagrant::Errors::ForwardPortCollision';
    
    const GUEST_CAPABILITY_INVALID = 'Vagrant::Errors::GuestCapabilityInvalid';
    
    const GUEST_CAPABILITY_NOT_FOUND = 'Vagrant::Errors::GuestCapabilityNotFound';
    
    const GUEST_EXPLICIT_NOT_DETECTED = 'Vagrant::Errors::GuestExplicitNotDetected';
    
    const GUEST_NOT_DETECTED = 'Vagrant::Errors::GuestNotDetected';
    
    const HOST_EXPLICIT_NOT_DETECTED = 'Vagrant::Errors::HostExplicitNotDetected';
    
    const LINUX_MOUNT_FAILED = 'Vagrant::Errors::LinuxMountFailed';
    
    const LINUX_RDP_CLIENT_NOT_FOUND = 'Vagrant::Errors::LinuxRDPClientNotFound';
    
    const LOCAL_DATA_DIR_NOT_ACCESSIBLE = 'Vagrant::Errors::LocalDataDirectoryNotAccessible';
    
    const MACHINE_ACTION_LOCKED = 'Vagrant::Errors::MachineActionLockedError';
    
    const MACHINE_GUEST_NOT_READY = 'Vagrant::Errors::MachineGuestNotReady';
    
    const MACHINE_LOCKED = 'Vagrant::Errors::MachineLocked';
    
    const MACHINE_NOT_FOUND = 'Vagrant::Errors::MachineNotFound';
    
    const MACHINE_STATE_INVALID = 'Vagrant::Errors::MachineStateInvalid';
    
    const MULTI_VM_TARGET_REQUIRED = 'Vagrant::Errors::MultiVMTargetRequired';
    
    const NETWORK_SSH_EXCEPTION = 'Vagrant::Errors::NetSSHException';
    
    const NETWORK_COLLISION = 'Vagrant::Errors::NetworkCollision';
    
    const NETWORK_ADDRESS_INVALID = 'Vagrant::Errors::NetworkAddressInvalid';
    
    const NETWORK_DHCP_ALREADY_ATTACHED = 'Vagrant::Errors::NetworkDHCPAlreadyAttached';
    
    const NETWORK_NOT_FOUND = 'Vagrant::Errors::NetworkNotFound';
    
    const NETWORK_TYPE_NOT_SUPPORTED = 'Vagrant::Errors::NetworkTypeNotSupported';
    
    const NETWORK_MANAGER_NOT_INSTALLED = 'Vagrant::Errors::NetworkManagerNotInstalled';
    
    const NFS_BAD_EXPORTS = 'Vagrant::Errors::NFSBadExports';
    
    const NFS_DUPE_PERMS = 'Vagrant::Errors::NFSDupePerms';
    
    const NFS_EXPORTS_FAILED = 'Vagrant::Errors::NFSExportsFailed';
    
    const NFS_CANT_READ_EXPORTS = 'Vagrant::Errors::NFSCantReadExports';
    
    const NFS_MOUNT_FAILED = 'Vagrant::Errors::NFSMountFailed';
    
    const NFS_NO_GUEST_IP = 'Vagrant::Errors::NFSNoGuestIP';
    
    const NFS_NO_HOST_IP = 'Vagrant::Errors::NFSNoHostIP';
    
    const NFS_NO_HOST_ONLY_NETWORK = 'Vagrant::Errors::NFSNoHostonlyNetwork';
    
    const NFS_NO_VALID_IDS = 'Vagrant::Errors::NFSNoValidIds';
    
    const NFS_NOT_SUPPORTED = 'Vagrant::Errors::NFSNotSupported';
    
    const NFS_CLIENT_NOT_INSTALLED_IN_GUEST = 'Vagrant::Errors::NFSClientNotInstalledInGuest';
    
    const NO_DEFAULT_PROVIDER = 'Vagrant::Errors::NoDefaultProvider';
    
    const NO_DEFAULT_SYNCED_FOLDER_IMPL = 'Vagrant::Errors::NoDefaultSyncedFolderImpl';
    
    const NO_ENVIRONMENT = 'Vagrant::Errors::NoEnvironmentError';
    
    const PACKAGE_INCLUDE_MISSING = 'Vagrant::Errors::PackageIncludeMissing';
    
    const PACKAGE_INCLUDE_SYMLINK = 'Vagrant::Errors::PackageIncludeSymlink';
    
    const PACKAGE_OUTPUT_IS_DIRECTORY = 'Vagrant::Errors::PackageOutputDirectory';
    
    const PACKAGE_OUTPUT_EXISTS = 'Vagrant::Errors::PackageOutputExists';
    
    const PACKAGE_REQUIRES_DIRECTORY = 'Vagrant::Errors::PackageRequiresDirectory';
    
    const POWERSHELL_NOT_FOUND = 'Vagrant::Errors::PowerShellNotFound';
    
    const POWERSHELL_INVALID_VERSION = 'Vagrant::Errors::PowerShellInvalidVersion';
    
    const POWERSHELL_ERROR = 'Vagrant::Errors::PowerShellError';
    
    const PROVIDER_CANT_INSTALL = 'Vagrant::Errors::ProviderCantInstall';
    
    const PROVIDER_CHECKSUM_MISMATCH = 'Vagrant::Errors::ProviderChecksumMismatch';
    
    const PROVIDER_INSTALL_FAILED = 'Vagrant::Errors::ProviderInstallFailed';
    
    const PROVIDER_NOT_FOUND = 'Vagrant::Errors::ProviderNotFound';
    
    const PROVIDER_NOT_FOUND_SUGGESTION = 'Vagrant::Errors::ProviderNotFoundSuggestion';
    
    const PROVIDER_NOT_USABLE = 'Vagrant::Errors::ProviderNotUsable';
    
    const PROVISIONER_FLAG_INVALID = 'Vagrant::Errors::ProvisionerFlagInvalid';

    const PROVISIONER_WINRM_UNSUPPORTED = 'Vagrant::Errors::ProvisionerWinRMUnsupported';
    
    const PLUGIN_GEM_NOT_FOUND = 'Vagrant::Errors::PluginGemNotFound';
    
    const PLUGIN_INSTALL_LICENSE_NOT_FOUND = 'Vagrant::Errors::PluginInstallLicenseNotFound';
    
    const PLUGIN_INSTALL_SPACE = 'Vagrant::Errors::PluginInstallSpace';
    
    const PLUGIN_INSTALL_VERSION_CONFLICT = 'Vagrant::Errors::PluginInstallVersionConflict';
    
    const PLUGIN_LOAD_FAILED = 'Vagrant::Errors::PluginLoadError';
    
    const PLUGIN_NOT_INSTALLED = 'Vagrant::Errors::PluginNotInstalled';
    
    const PLUGIN_STATE_FILE_PARSE_FAILED = 'Vagrant::Errors::PluginStateFileParseError';
    
    const PLUGIN_UNINSTALL_SYSTEM = 'Vagrant::Errors::PluginUninstallSystem';
    
    const PLUGIN_INIT_FAILED = 'Vagrant::Errors::PluginInitError';
    
    const PLUGIN_SOURCE_ERROR = 'Vagrant::Errors::PluginSourceError';
    
    const PLUGIN_NO_LOCAL = 'Vagrant::Errors::PluginNoLocalError';
    
    const PLUGIN_MISSING_LOCAL = 'Vagrant::Errors::PluginMissingLocalError';
    
    const PUSHES_NOT_DEFINED = 'Vagrant::Errors::PushesNotDefined';
    
    const PUSH_STRATEGY_NOT_DEFINED = 'Vagrant::Errors::PushStrategyNotDefined';
    
    const PUSH_STRATEGY_NOT_LOADED = 'Vagrant::Errors::PushStrategyNotLoaded';
    
    const PUSH_STRATEGY_NOT_PROVIDED = 'Vagrant::Errors::PushStrategyNotProvided';
    
    const RSYNC_POST_COMMAND_ERROR = 'Vagrant::Errors::RSyncPostCommandError';
    
    const RSYNC_GENERIC = 'Vagrant::Errors::RSyncError';
    
    const RSYNC_NOT_FOUND = 'Vagrant::Errors::RSyncNotFound';
    
    const RSYNC_NOT_INSTALLED_IN_GUEST = 'Vagrant::Errors::RSyncNotInstalledInGuest';
    
    const RSYNC_GUEST_INSTALL_ERROR = 'Vagrant::Errors::RSyncGuestInstallError';
    
    const SCP_PERMISSION_DENIED = 'Vagrant::Errors::SCPPermissionDenied';
    
    const SCP_UNAVAILABLE = 'Vagrant::Errors::SCPUnavailable';
    
    const SHARED_FOLDER_CREATE_FAILED = 'Vagrant::Errors::SharedFolderCreateFailed';
    
    const SHELL_EXPAND_FAILED = 'Vagrant::Errors::ShellExpandFailed';
    
    const SNAPSHOT_CONFLICT_FAILED = 'Vagrant::Errors::SnapshotConflictFailed';
    
    const SNAPSHOT_NOT_FOUND = 'Vagrant::Errors::SnapshotNotFound';
    
    const SNAPSHOT_NOT_SUPPORTED = 'Vagrant::Errors::SnapshotNotSupported';
    
    const SSH_AUTH_FAILED = 'Vagrant::Errors::SSHAuthenticationFailed';
    
    const SSH_CHANNEL_OPEN_FAILED = 'Vagrant::Errors::SSHChannelOpenFail';
    
    const SSH_CONNECT_EACCES = 'Vagrant::Errors::SSHConnectEACCES';
    
    const SSH_CONNECTION_REFUSED = 'Vagrant::Errors::SSHConnectionRefused';
    
    const SSH_CONNECTION_ABORTED = 'Vagrant::Errors::SSHConnectionAborted';
    
    const SSH_CONNECTION_RESET = 'Vagrant::Errors::SSHConnectionReset';
    
    const SSH_CONNECTION_TIMEOUT = 'Vagrant::Errors::SSHConnectionTimeout';
    
    const SSH_DISCONNECTED = 'Vagrant::Errors::SSHDisconnected';
    
    const SSH_HOST_DOWN = 'Vagrant::Errors::SSHHostDown';
    
    const SSH_INVALID_SHELL = 'Vagrant::Errors::SSHInvalidShell';
    
    const SSH_INSERT_KEY_UNSUPPORTED = 'Vagrant::Errors::SSHInsertKeyUnsupported';
    
    const SSH_IS_PUTTY_LINK = 'Vagrant::Errors::SSHIsPuttyLink';
    
    const SSH_KEY_BAD_OWNER = 'Vagrant::Errors::SSHKeyBadOwner';
    
    const SSH_KEY_BAD_PERMISSIONS = 'Vagrant::Errors::SSHKeyBadPermissions';
    
    const SSH_KEY_TYPE_NOT_SUPPORTED = 'Vagrant::Errors::SSHKeyTypeNotSupported';
    
    const SSH_NO_ROUTE = 'Vagrant::Errors::SSHNoRoute';
    
    const SSH_NOT_READY = 'Vagrant::Errors::SSHNotReady';
    
    const SSH_RUN_REQUIRES_KEYS = 'Vagrant::Errors::SSHRunRequiresKeys';
    
    const SSH_UNAVAILABLE = 'Vagrant::Errors::SSHUnavailable';
    
    const SSH_UNAVAILABLE_WINDOWS = 'Vagrant::Errors::SSHUnavailableWindows';
    
    const SYNCED_FOLDER_UNUSABLE = 'Vagrant::Errors::SyncedFolderUnusable';
    
    const TRIGGERS_BAD_EXIT_CODES = 'Vagrant::Errors::TriggersBadExitCodes';
    
    const TRIGGERS_GUEST_NOT_EXIST = 'Vagrant::Errors::TriggersGuestNotExist';
    
    const TRIGGERS_GUEST_NOT_RUNNING = 'Vagrant::Errors::TriggersGuestNotRunning';
    
    const TRIGGERS_NO_BLOCKS_GIVEN = 'Vagrant::Errors::TriggersNoBlockGiven';
    
    const TRIGGERS_NO_STAGE_GIVEN = 'Vagrant::Errors::TriggersNoStageGiven';
    
    const UI_EXPECTS_TTY = 'Vagrant::Errors::UIExpectsTTY';
    
    const UNIMPLEMENTED_PROVIDER_ACTION = 'Vagrant::Errors::UnimplementedProviderAction';
    
    const UPLOAD_INVALID_COMPRESSION_TYPE = 'Vagrant::Errors::UploadInvalidCompressionType';
    
    const UPLOAD_MISSING_EXTRACT_CAPABILITY = 'Vagrant::Errors::UploadMissingExtractCapability';
    
    const UPLOAD_MISSING_TEMP_CAPABILITY = 'Vagrant::Errors::UploadMissingTempCapability';
    
    const UPLOAD_SOURCE_MISSING = 'Vagrant::Errors::UploadSourceMissing';
    
    const UPLOAD_GENERIC = 'Vagrant::Errors::UploaderError';
    
    const UPLOAD_INTERRUPTED = 'Vagrant::Errors::UploaderInterrupted';
    
    const VAGRANT_INTERRUPTED = 'Vagrant::Errors::VagrantInterrupt';
    
    const VAGRANTFILE_EXISTS = 'Vagrant::Errors::VagrantfileExistsError';
    
    const VAGRANTFILE_LOAD_FAILED = 'Vagrant::Errors::VagrantfileLoadError';
    
    const VAGRANTFILE_NAME_ERROR = 'Vagrant::Errors::VagrantfileNameError';
    
    const VAGRANTFILE_SYNTAX_ERROR = 'Vagrant::Errors::VagrantfileSyntaxError';
    
    const VAGRANTFILE_TEMPLATE_NOT_FOUND = 'Vagrant::Errors::VagrantfileTemplateNotFoundError';
    
    const VAGRANTFILE_WRITE_FAILED = 'Vagrant::Errors::VagrantfileWriteError';
    
    const VAGRANT_VERSION_BAD = 'Vagrant::Errors::VagrantVersionBad';
    
    const VBOXMANAGE_GENERIC = 'Vagrant::Errors::VBoxManageError';
    
    const VBOXMANAGE_LAUNCH_FAILED = 'Vagrant::Errors::VBoxManageLaunchError';
    
    const VBOXMANAGE_NOT_FOUND = 'Vagrant::Errors::VBoxManageNotFoundError';
    
    const VIRTUALBOX_BROKEN_VERSION_040214 = 'Vagrant::Errors::VirtualBoxBrokenVersion040214';
    
    const VIRTUALBOX_GUEST_PROPERTY_NOT_FOUND = 'Vagrant::Errors::VirtualBoxGuestPropertyNotFound';
    
    const VIRTUALBOX_INVALID_VERSION = 'Vagrant::Errors::VirtualBoxInvalidVersion';
    
    const VIRTUALBOX_NO_ROOM_FOR_HIGH_LEVEL_NETWORK = 'Vagrant::Errors::VirtualBoxNoRoomForHighLevelNetwork';
    
    const VIRTUALBOX_NOT_DETECTED = 'Vagrant::Errors::VirtualBoxNotDetected';
    
    const VIRTUALBOX_KERNEL_MODULE_NOT_LOADED = 'Vagrant::Errors::VirtualBoxKernelModuleNotLoaded';
    
    const VIRTUALBOX_INSTALL_INCOMPLETE = 'Vagrant::Errors::VirtualBoxInstallIncomplete';
    
    const VIRTUALBOX_NO_NAME = 'Vagrant::Errors::VirtualBoxNoName';
    
    const VIRTUALBOX_MOUNT_FAILED = 'Vagrant::Errors::VirtualBoxMountFailed';
    
    const VIRTUALBOX_MOUNT_NOT_SUPPORTED_BSD = 'Vagrant::Errors::VirtualBoxMountNotSupportedBSD';
    
    const VIRTUALBOX_NAME_EXISTS = 'Vagrant::Errors::VirtualBoxNameExists';
    
    const VIRTUALBOX_USER_MISMATCH = 'Vagrant::Errors::VirtualBoxUserMismatch';
    
    const VIRTUALBOX_VERSION_EMPTY = 'Vagrant::Errors::VirtualBoxVersionEmpty';
    
    const VM_BASE_MAC_NOT_SPECIFIED = 'Vagrant::Errors::VMBaseMacNotSpecified';
    
    const VM_BOOT_BAD_STATE = 'Vagrant::Errors::VMBootBadState';
    
    const VM_BOOT_TIMEOUT = 'Vagrant::Errors::VMBootTimeout';
    
    const VM_CLONE_FAILURE = 'Vagrant::Errors::VMCloneFailure';
    
    const VM_CREATE_MASTER_FAILURE = 'Vagrant::Errors::VMCreateMasterFailure';
    
    const VM_CUSTOMISATION_FAILED = 'Vagrant::Errors::VMCustomizationFailed';
    
    const VM_IMPORT_FAILURE = 'Vagrant::Errors::VMImportFailure';
    
    const VM_INACCESSIBLE = 'Vagrant::Errors::VMInaccessible';
    
    const VM_NAME_EXISTS = 'Vagrant::Errors::VMNameExists';
    
    const VM_NO_MATCH = 'Vagrant::Errors::VMNoMatchError';
    
    const VM_NOT_CREATED = 'Vagrant::Errors::VMNotCreatedError';
    
    const VM_NOT_FOUND = 'Vagrant::Errors::VMNotFoundError';
    
    const VM_NOT_RUNNING = 'Vagrant::Errors::VMNotRunningError';
    
    const VM_POWER_OFF_TO_PACKAGE = 'Vagrant::Errors::VMPowerOffToPackage';
    
    const WINRM_INVALID_COMMUNICATOR = 'Vagrant::Errors::WinRMInvalidCommunicator';
    
    const WSL_VAGRANT_VERSION_MISMATCH = 'Vagrant::Errors::WSLVagrantVersionMismatch';
    
    const WSL_VAGRANT_ACCESS_ERROR = 'Vagrant::Errors::WSLVagrantAccessError';
    
    const WSL_VIRTUALBOX_WINDOWS_ACCESS_ERROR = 'Vagrant::Errors::WSLVirtualBoxWindowsAccessError';
    
    const WSL_ROOT_FILESYSTEM_NOT_FOUND = 'Vagrant::Errors::WSLRootFsNotFoundError';
    
}
