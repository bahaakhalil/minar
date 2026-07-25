<?php

namespace App\Policies;

use App\Models\JobRecord;
use App\Models\User;

/**
 * Policy بسيطة تتحكم بمين يقدر يعمل إيش على مهمة (Job) معيّنة.
 * القاعدة الأساسية: كل طرف يتحكم بمرحلته فقط:
 * - الحرفي المعيّن: يبدأ وينهي العمل.
 * - العميل صاحب المهمة: يؤكد الإتمام.
 */
class JobPolicy
{
    /**
     * هل يقدر هذا المستخدم يبدأ تنفيذ المهمة؟
     * مسموح فقط للحرفي المعيّن على هذه المهمة تحديدًا.
     */
    public function start(User $user, JobRecord $job): bool
    {
        return $user->isCraftsman()
            && $job->craftsman_id === $user->craftsman->id;
    }

    /**
     * هل يقدر هذا المستخدم ينهي تنفيذ المهمة (يعلن أنه خلّص الشغل)؟
     * نفس شرط start: فقط الحرفي المعيّن.
     */
    public function finish(User $user, JobRecord $job): bool
    {
        return $user->isCraftsman()
            && $job->craftsman_id === $user->craftsman->id;
    }

    /**
     * هل يقدر هذا المستخدم يؤكد إتمام العمل ويحرر الدفعة؟
     * مسموح فقط للعميل صاحب هذه المهمة تحديدًا.
     */
    public function confirm(User $user, JobRecord $job): bool
    {
        return $user->isClient()
            && $job->client_id === $user->client->id;
    }

    /**
     * هل يقدر هذا المستخدم يشوف تفاصيل المهمة؟
     * مسموح للعميل صاحبها، أو الحرفي المكلّف، أو الأدمن.
     */
    public function view(User $user, JobRecord $job): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return ($user->isClient() && $job->client_id === $user->client->id)
            || ($user->isCraftsman() && $job->craftsman_id === $user->craftsman->id);
    }
}
