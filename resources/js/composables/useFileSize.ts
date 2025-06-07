export function useFileSize() {
    const formatFileSize = (bytes: number, useMB = false): string => {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));

        // If useMB is true and the size is at least 1MB, format as MB
        if (useMB && i >= 2) {
            const mbSize = bytes / (k * k);
            return `${mbSize.toFixed(2)} MB`;
        }

        // Otherwise use the standard format
        return `${parseFloat((bytes / Math.pow(k, i)).toFixed(2))} ${sizes[i]}`;
    };

    return {
        formatFileSize,
    };
} 